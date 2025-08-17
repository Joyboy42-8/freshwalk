<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\Category;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function home() {
        $produits = Produit::with("categorie")->where("is_active", true)
        ->where("stock", ">", 1)->latest()->take(3)->get();
        return view("front.dashboard", compact("produits"));
    }

    public function index() {
        $produits = Produit::with("categorie")->where("is_active", true)
        ->where("stock", ">", 1)
        ->paginate(6);
        return view("front.produits", compact("produits"));
    }

    public function show(Produit $produit, Request $request) {
        if(!$produit->is_active) {
            abort(404);
        }
        $produit->load([
            "categorie", 
            "avis" => function ($query) {$query->where('approuve', true)->with('user');}
        ]);

        try {
            Activity::create([
                "user_id" => Auth::id(),
                "action" => "Client consulte un produit",
                "subject_type" => Produit::class,
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

        return view("front.one-product", compact("produit"));
    }

    public function catalogues() {
        $categories = Category::paginate(6);
        return view("front.catalogue", ["categories"=> $categories]);
    }

    public function catalog(Category $categorie) {
        $produits = $categorie->produits()
        ->where('is_active', true)
        ->with('categorie')
        ->paginate(5);
        return view("front.one-catalog", compact("produits", "categorie"));
    }
}