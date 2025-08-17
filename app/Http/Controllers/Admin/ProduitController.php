<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\Category;
use App\Http\Requests\ProduitRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::paginate(5);
        return view("admin.produits.index", compact("produits"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.produits.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // Générer/fiabiliser le slug si besoin
        $data['slug'] = $data['slug'] ?: Str::slug($data['nom']);

        // Upload
        if ($request->hasFile('image')) {
            // nom de fichier unique et propre
            $filename = time().'_'.Str::slug($data['nom']).'.'.$request->file('image')->extension();
            // stockage sur le disque public dans /produits
            $path = $request->file('image')->storeAs('produits', $filename, 'public');
            // on garde le chemin relatif "produits/xxx.ext"
            $data['image'] = $path;
        }

        Produit::create($data);

        return redirect()->route('produits.index')->with('success', 'Produit ajouté !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        $produit->load("categorie");
        return view("admin.produits.show", compact("produit"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        $categories = Category::all();
        return view("admin.produits.edit", compact("produit", "categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit $produit)
    {
        // Si une nouvelle image est uploadée
        if ($request->hasFile('image')) {
            // On garde l'ancienne image si besoin ou on renomme
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('produits', $imageName, 'public');
    
            // On met à jour le nom du fichier dans la BDD
            $produit->image = 'produits/' . $imageName;
        }
    
        // Mise à jour des autres champs
        $produit->categorie_id = $request->categorie_id;
        $produit->nom = $request->nom;
        $produit->slug = $request->slug;
        $produit->description = $request->description;
        $produit->prix = $request->prix;
        $produit->stock = $request->stock;    
        $produit->save();
    
        return redirect()->route('produits.index')->with('success', 'Produit modifié avec succès !');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        // supprimer le fichier pour éviter les orphelins
        if ($produit->image && Storage::disk('public')->exists($produit->image)) {
            Storage::disk('public')->delete($produit->image);
        }

        $produit->delete();

        return redirect()->route('produits.index')->with('success', 'Produit supprimé !');
    }

    // Activer et désactiver un produit
    public function toggle($id){
        $produit = Produit::findOrFail($id);

        // Toggle actif/inactif
        $produit->is_active = !$produit->is_active;

        $produit->save();

        return redirect()->back()->with('success', 'Etat produit mis à jour !');
    }
}
