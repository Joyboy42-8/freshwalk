<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\ProduitController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CommandeController;
use App\Http\Controllers\Admin\AvisController;
use App\Http\Controllers\Front\PanierController;
use Illuminate\Support\Facades\Route;

// Routes Publics
// Landing Page
Route::get('/', function () {
    return view('welcome');
})->name("home");
// Page Contact
Route::get("/contact", function () {
    return view("contact");
})->name("contact");

// Routes pour Joyboy
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    // Statistiques
    $nbClients = App\Models\User::count();
    $nbProduits = App\Models\Produit::count();
    $nbCategories = App\Models\Category::count();
    Route::get('/admin/panel', fn() => view('admin.panel',["nbClients" => $nbClients, "nbProduits" => $nbProduits, "nbCategories" => $nbCategories]))->name('admin.panel');
    // Les ressources
    Route::resource("categories", CategorieController::class)->parameters(["categories" => "categorie"]);
    Route::resource("produits", ProduitController::class)->parameters(["produits" => "produit"]);
    Route::resource("clients", UserController::class)->parameters(["clients" => "client"])->only(["index", "show"]);
    Route::resource("commandes", CommandeController::class)->parameters(["commandes" => "commande"])->only(["index", "show"]);

    // Activation et désactivation de compte client et de produit
    Route::patch("/clients/{id}/toggle", [UserController::class, "toggle"])->name("clients.toggle");
    Route::patch("/produits/{id}/toggle", [ProduitController::class, "toggle"])->name("produits.toggle");

    // Gestions des commandes
    Route::patch("commandes/validate/{commande}", [CommandeController::class, "validateOrder"])->name("commandes.validate");
    Route::patch("commandes/cancel/{commande}", [CommandeController::class, "cancelOrder"])->name("commandes.cancel");

    // Gestions des avis
    Route::get("/avis/index", [AvisController::class, "index"])->name("avis.index");
    Route::patch("/avis/{id}/toggle", [AvisController::class, "toggle"])->name("avis.toggle");

    // Gestion des historiques
    
});


// Routes (Client)
Route::middleware(['auth', 'verified', "active"])->group(function() {
    Route::prefix("dashboard")->name("dashboard.")->group(function() {
        // Produits
        Route::controller(App\Http\Controllers\Front\ProduitController::class)->group(function() {
            // Dashboard Client
            Route::get('/', "home")->name("home");
            // Affichez tous les produits
            Route::get("/produits", "index")->name("produits");
            // Afficher un produit
            Route::get("/produits/{produit}", "show")->name("one-produit");
        });

        // Catégories
        Route::controller(App\Http\Controllers\Front\ProduitController::class)->group(function() {
            // Afficher les catégories
            Route::get("/catalogues", "catalogues")->name("catalogues");
            // Afficher une catégorie avec les produits qu'il contient
            Route::get("/catalogues/{categorie}", "catalog")->name("one-catalogue");
        });

        // Panier
        Route::controller(PanierController::class)->prefix("panier")->name("panier.")->group(function() {
            Route::get('/', 'index')->name('home');
            Route::post('/add/{produit}', 'add')->name('add');
            Route::patch('/update/{panier}', 'update')->name('update');
            Route::delete('/remove/{panier}', 'remove')->name('remove');
        });

        // Commandes
        Route::controller(App\Http\Controllers\Front\CommandeController::class)
        ->prefix("commandes")
        ->name("commandes.")
        ->group(function() {
            Route::get('/', 'index')->name('all');
            Route::get('/{commande}', 'show')->name('show');
            Route::post('/store', 'store')->name('store');
            Route::delete('/{commande}', 'cancel')->name('cancel');
        });
    });

    // Avis
    Route::controller(App\Http\Controllers\Front\AvisController::class)->prefix("avis")->name("avis.")->group(function() {
        Route::get("/", "index")->name("all");
        Route::get("/create/{commande}",  "create")->name("create");
        Route::post("/store/{commande}/{produit}",  "store")->name("store");
    });
});

// Routes de gestion de profile
Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->name("profile.")->group(function() {
        Route::get('/profile', 'edit')->name('edit');
        Route::patch('/profile', 'update')->name('update');
        Route::delete('/profile', 'destroy')->name('destroy');
    });
});

// Routes d'erreurs
Route::fallback(function () {
    return view("404");
});

require __DIR__.'/auth.php';
