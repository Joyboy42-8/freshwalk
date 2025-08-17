<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{   
    protected $fillable = [
        "categorie_id",
        "nom", 
        "slug",
        "description",
        "prix", 
        "stock",
        "image", 
        "is_active"
    ];

    public function categorie() {
        return $this->belongsTo(Category::class, "categorie_id");
    }

    public function avis() {
        return $this->hasMany(Avis::class);
    }

    public function commandes_items() {
        return $this->hasMany(CommandeItems::class);
    }
}
