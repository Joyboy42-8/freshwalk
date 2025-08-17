<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Panier;
use App\Models\Produit;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    public function index() {
        $paniers = Auth::user()->paniers()->with("produit")->get();
        return view("front.panier.index", compact("paniers"));
    }

    // Ajouter un produit au panier
    public function add(Produit $produit, Request $request) {
        $request->validate(["quantite" => "integer|min:1|required"]);
        $item = Auth::user()->paniers()->where('produit_id', $produit->id)->first();

        if ($item) {
            $item->increment('quantite');
        } else {
            Panier::create([
                'user_id' => Auth::id(),
                'produit_id' => $produit->id,
                'quantite' => $request->quantite,
            ]);
        }

        try {
            Activity::create([
                "user_id" => Auth::id(),
                "action" => "Ajout de produit au panier",
                "subject_type" => Panier::class,
                "subject_id" => $produit->id,
                "properties" => [
                    "nom" => $produit->nom,
                    "prix" => $produit->prix
                ],
                "ip" => $request->ip(),
                "user_agent" => $request->userAgent(),
            ]);
        } catch (\Throwable $e) {
            // Affiche l'erreur si ça plante
            return redirect()->back()->with('error', 'Erreur lors de la création du log : '.$e->getMessage());
        }

        return redirect()->route("dashboard.produits")->with('success', 'Produit ajouté au panier !');
    }

    // Supprimer un produit du panier
    public function remove(Panier $panier, Request $request) {
        $panier->delete();
        try {
            Activity::create([
                "user_id" => Auth::id(),
                "action" => "Suppression d'un produit du panier",
                "subject_type" => Panier::class,
                "subject_id" => $panier->id,
                "properties" => [
                    "produit_id" => $panier->produit_id,
                    "quantite" => $panier->quantite
                ],
                "ip" => $request->ip(),
                "user_agent" => $request->userAgent(),
            ]);
        } catch (\Throwable $e) {
            // Affiche l'erreur si ça plante
            return redirect()->back()->with('error', 'Erreur lors de la création du log : '.$e->getMessage());
        }
        return redirect()->back()->with('success', 'Produit supprimé du panier !');
    }

    // Mettre à jour la quantité
    public function update(Request $request, Panier $panier) {
        $request->validate([
            "quantite" => "required|integer|min:1"
        ]);

        $panier->update([
            'quantite' => $request->quantite,
        ]);

        try {
            Activity::create([
                "user_id" => Auth::id(),
                "action" => "Modification de quantité de produit du panier",
                "subject_type" => Panier::class,
                "subject_id" => $panier->id,
                "properties" => [
                    "produit_id" => $panier->produit_id,
                    "quantite" => $panier->quantite
                ],
                "ip" => $request->ip(),
                "user_agent" => $request->userAgent(),
            ]);
        } catch (\Throwable $e) {
            // Affiche l'erreur si ça plante
            return redirect()->back()->with('error', 'Erreur lors de la création du log : '.$e->getMessage());
        }
        
        return redirect()->back()->with('success', 'Quantité mise à jour !');
    }

    // Nombre total de produits dans le panier (pour l’icône)
    public static function totalItems() {
        if(Auth::check()) {
            return Auth::user()->paniers()->sum('quantite');
        }
        return 0;
    }
}
