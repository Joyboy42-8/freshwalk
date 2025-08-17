<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Models\Panier;
use App\Models\Commande;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function store(Request $request)
    {
    // Récupérer le panier de l'utilisateur
    $paniers = Panier::where('user_id', Auth::id())->with('produit')->get();

    // Validation de l'adresse
    $request->validate([
    'adresse' => 'required|string|min:5'
    ]);

    if ($paniers->isEmpty()) {
    return redirect()->back()->with('error', 'Votre panier est vide.');
    }

    // Calcul du total
    $total = 0;
    foreach ($paniers as $item) {
    $total += $item->produit->prix * $item->quantite;
    }

    // Création de la commande
    $commande = Commande::create([
    "user_id" => Auth::id(),
    "prix_total" => $total,
    "adresse" => $request->adresse
    ]);

    // Ajouter les produits à la commande
    foreach ($paniers as $item) {
    $commande->produits()->attach($item->produit_id, [
    'quantite' => $item->quantite,
    'prix'     => $item->produit->prix
    ]);
    }

    // 🔹 Log dans la table Activity
    try {
    Activity::create([
        "user_id" => Auth::id(),
        "action" => "Envoi de commande",
        "subject_type" => Commande::class,
        "subject_id" => $commande->id,
        "properties" => [
        "total" => $commande->prix_total,
        "adresse" => $commande->adresse
        ],
        "ip" => $request->ip(),
        "user_agent" => $request->userAgent(),
    ]);
    } catch (\Throwable $e) {
        // Affiche l'erreur si ça plante
        return redirect()->back()->with('error', 'Erreur lors de la création du log : '.$e->getMessage());
    }

    // Vider le panier
    Panier::where('user_id', Auth::id())->delete();

    return redirect()->route('dashboard.panier.home')
            ->with('success', 'Commande envoyée avec succès !');
    }

    public function index() {
        $commandes = Commande::where("user_id", Auth::id())->orderByDesc('created_at')->paginate(10);
        return view("front.commandes", ["commandes" => $commandes]);
    }

    public function show(int $id) {
        $commande = Commande::with("produits")
                    ->where("id", $id)
                    ->where("user_id", Auth::id())->firstOrFail();

        return view("front.one-commande", compact("commande"));
    }

    public function cancel(Commande $commande, Request $request) {
        if($commande->status !== "validated" && $commande->status !== "cancelled") {
            $commande->delete();
            // 🔹 Log dans la table Activity
            try {
                Activity::create([
                    "user_id" => Auth::id(),
                    "action" => "Suppression de commande",
                    "subject_type" => Commande::class,
                    "subject_id" => $commande->id,
                    "properties" => [
                        "total" => $commande->prix_total,
                        "adresse" => $commande->adresse
                    ],
                    "ip" => $request->ip(),
                    "user_agent" => $request->userAgent(),
                ]);
            } catch (\Throwable $e) {
                // Affiche l'erreur si ça plante
                return redirect()->back()->with('error', 'Erreur lors de la création du log : '.$e->getMessage());
            }
            return redirect()->route('dashboard.commandes.all')->with('success', 'Commande supprimée avec succès !');
        }
        return redirect()->route('dashboard.commandes.all')->with('error', 'Cette commande a déja été validée ou supprimée !');
    }
}
