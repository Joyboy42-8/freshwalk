<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $avis = Avis::with("user")->orderBy("created_at","desc")->paginate(10);
        return view("admin.avis.index", compact("avis"));
    }

    public function toggle($id, Request $request) {
        $avis = Avis::findOrFail($id);

        $avis->approuve = !$avis->approuve;

        $avis->save();

        try {
            Activity::create([
                "user_id" => Auth::id(),
                "action" => "Joyboy a changé le statut d'un avis",
                "subject_type" => Avis::class,
                "subject_id" => $avis->id,
                "properties" => [
                    "user" => $avis->user_id,
                    "contenu" => $avis->avis,
                ],
                "ip" => $request->ip(),
                "user_agent" => $request->userAgent(),
            ]);
        } catch (\Throwable $e) {
            // Affiche l'erreur si ça plante
            return redirect()->back()->with('error', 'Erreur lors de la création du log : '.$e->getMessage());
        }

        return redirect()->back()->with('success', 'Statut de l\'avis mis à jour !');
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
        //
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
