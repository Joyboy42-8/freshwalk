<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        "user_id",
        "prix_total",
        "adresse"
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function produits(){
        return $this->belongsToMany(Produit::class, 'commandes_items')
            ->withPivot('quantite', 'prix')
            ->withTimestamps();
    }

    public function commandes_items() {
        return $this->hasMany(CommandeItems::class);
    }
}
