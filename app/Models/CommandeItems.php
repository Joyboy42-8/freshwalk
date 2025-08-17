<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommandeItems extends Model
{
    protected $fillable = [
        "commande_id",
        "produit_id",
        "quantite",
        "prix"
    ];

    public function commande() {
        return $this->belongsTo(Commande::class);
    }

    public function produit() {
        return $this->belongsTo(Produit::class);
    }
}
