<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Produit;
use App\Models\Avis;
use App\Models\Commande;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AvisController extends Controller
{
    public function index() {
        $avis = Avis::where('user_id', Auth::id())
                ->orderByDesc('created_at')
                ->paginate(5);

        return view("front.avis.index", compact("avis"));
    }

    public function create(Commande $commande) {
        $commande->load("produits");

        // Produits déjà avisés par l'utilisateur
        $produitsAvises = $commande->produits()
            ->whereHas('avis', function(   $q) {
                $q->where('user_id', Auth::id());
            })
            ->with(['avis' => function($q) {
                $q->where('user_id', Auth::id());
            }])
            ->get();

        // Produits restants à évaluer
        $produitsRestants = $commande->produits()
            ->whereDoesntHave('avis', function($q) {
                $q->where('user_id', Auth::id());
            })->get();

        return view("front.avis.create", compact("commande", "produitsAvises", "produitsRestants"));
    }

    public function store(Request $request, Commande $commande, Produit $produit, Avis $avis) {
        $request->validate([
            "avis" => "string|required",
            "note" => "integer|min:1|max:5|required"
        ]);

        // Vérifier si l'utilisateur a déjà laissé un avis pour ce produit
        $exists = Avis::where('user_id', Auth::id())
                      ->where('produit_id', $produit->id)
                      ->exists();
    
        if ($exists) {
            return redirect()->route("avis.create", $commande->id)
                             ->with('error', 'Vous avez déjà laissé un avis pour ce produit.');
        }

        // Création de l'avis
        Avis::create([
            "user_id"    => Auth::id(),
            "produit_id" => $produit->id,
            "avis"       => $request->avis,
            "note"       => $request->note,
        ]);

        try {
            Activity::create([
                "user_id" => Auth::id(),
                "action" => "Envoi d'avis",
                "subject_type" => Avis::class,
                "subject_id" => $avis->id,
                "properties" => [
                    "note" => $avis->note,
                    "approuve" => $avis->approuve
                ],
                "ip" => $request->ip(),
                "user_agent" => $request->userAgent(),
            ]);
        } catch (\Throwable $e) {
            // Affiche l'erreur si ça plante
            return redirect()->back()->with('error', 'Erreur lors de la création du log : '.$e->getMessage());
        }

        return redirect()->route('avis.create', $commande->id)
                         ->with('success', 'Votre avis a été enregistré. Continuez pour les autres produits.');
    }

}
