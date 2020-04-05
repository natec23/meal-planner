<?php

namespace App\Http\Controllers\Recipies;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\Recipies\Recipie;
use App\Http\Requests\Recipies\RecipieRequest;

class RecipieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipies = Recipie::all();

        return view('recipies.recipies', ['recipies' => $recipies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recipies.edit', ['recipie' => FALSE]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecipieRequest $request)
    {
        $recipie = new Recipie;
        $recipie->fill($request->all());
        $recipie->author_id = Auth::id();
        $recipie->save();

        return redirect(route('recipie.edit', $recipie));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recipies  $recipies
     * @return \Illuminate\Http\Response
     */
    public function show(Recipie $recipie)
    {
        return view('recipies.show', ['recipie' => $recipie]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recipies  $recipie
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipie $recipie)
    {
        return view('recipies.edit', ['recipie' => $recipie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipies  $recipies
     * @return \Illuminate\Http\Response
     */
    public function update(RecipieRequest $request, Recipie $recipie)
    {
        $recipie->fill($request->all());
        $recipie->save();

        return redirect(route('recipie.show', $recipie));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipies\Recipie  $recipie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipie $recipie)
    {
        $recipie->delete();
        return redirect(route('recipie.index'));
    }
}
