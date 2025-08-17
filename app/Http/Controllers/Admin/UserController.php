<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = User::all();
        return view("admin.clients.index", compact("clients"));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    public function show(User $client)
    {
        $commandes = $client->commandes()->paginate(5);
        return view("admin.clients.show", compact("client", "commandes"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     //
    // }

    // Disable a user
    public function toggle($id, User $user, Request $request){
        $client = User::findOrFail($id); // ou Client::findOrFail si tu as un modèle Client

        // Toggle actif/inactif
        $client->is_active = !$client->is_active;

        $client->save();

        try {
            Activity::create([
                "user_id" => Auth::id(),
                "action" => "Désactivation/Activation compte client",
                "subject_type" => User::class,
                "subject_id" => $user->id,
                "properties" => [
                    "name" => $user->name,
                    "email" => $user->email
                ],
                "ip" => $request->ip(),
                "user_agent" => $request->userAgent(),
            ]);
        } catch (\Throwable $e) {
            // Affiche l'erreur si ça plante
            return redirect()->back()->with('error', 'Erreur lors de la création du log : '.$e->getMessage());
        }

        return redirect()->back()->with('success', 'Statut du client mis à jour !');
    }
}
