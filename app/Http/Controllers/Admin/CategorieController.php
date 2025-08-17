<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(5);
        return view("admin.categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()->route("categories.index")->with("success","Catégorie ajoutée avec succès !");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $categorie)
    {
        $produits = $categorie->produits()->paginate(5);
        return view("admin.categories.show", compact("categorie", "produits"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $categorie)
    {
        return view("admin.categories.edit", compact("categorie"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $categorie)
    {
        $categorie->update($request->validated());

        return redirect()->route("categories.index")->with("success","Catégorie modifiée avec succès !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $categorie)
    {
        $categorie->delete();
        return redirect()->route("categories.index")->with('success', 'Catégorie supprimée avec succès !');
    }
}
