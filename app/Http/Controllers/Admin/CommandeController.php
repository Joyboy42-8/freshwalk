<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\FactureCommandeMail;
use App\Models\Commande;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commandes = Commande::with("user")->latest()->paginate(5);
        return view("admin.commandes.index", compact("commandes"));
    }

    // Validate a command
    public function validateOrder($id, Request $request) {
        $commande = Commande::with('user', 'produits')->findOrFail($id);
        $commande->status = "validated";
        $commande->save();


        // Envoyer le mail
        Mail::to($commande->user->email)->send(new FactureCommandeMail($commande));

        foreach($commande->produits as $produit) {
            $produit->stock -= $produit->pivot->quantite;
            $produit->save();
        }

        try {
            Activity::create([
                "user_id" => Auth::id(),
                "action" => "Validation commande par Joyboy",
                "subject_type" => Commande::class,
                "subject_id" => $commande->id,
                "properties" => [
                    "quantite" => $commande->quantite,
                    "prix_total" => $commande->prix_total
                ],
                "ip" => $request->ip(),
                "user_agent" => $request->userAgent(),
            ]);
        } catch (\Throwable $e) {
            // Affiche l'erreur si ça plante
            return redirect()->back()->with('error', 'Erreur lors de la création du log : '.$e->getMessage());
        }

        return redirect()->route("commandes.index")->with("success","Commande Validée et facture envoyée à ce mail " . $commande->user->email . "!");
    }

    // Cancel an order
    public function cancelOrder(Commande $commande, Request $request) {
        $commande->status = "cancelled";
        $commande->save();

        try {
            Activity::create([
                "user_id" => Auth::id(),
                "action" => "Annulation commande par Joyboy",
                "subject_type" => Commande::class,
                "subject_id" => $commande->id,
                "properties" => [
                    "quantite" => $commande->quantite,
                    "prix_total" => $commande->prix_total
                ],
                "ip" => $request->ip(),
                "user_agent" => $request->userAgent(),
            ]);
        } catch (\Throwable $e) {
            // Affiche l'erreur si ça plante
            return redirect()->back()->with('error', 'Erreur lors de la création du log : '.$e->getMessage());
        }

        return redirect()->route("commandes.index")->with("success","Commande Annulée !");
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $commande = Commande::with("produits")->find($id);

        return view("admin.commandes.show", compact("commande"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
