<?php

namespace App\Http\Controllers;

use App\Models\KeyWord;
use App\Http\Requests\StoreKeyWordRequest;
use App\Http\Requests\UpdateKeyWordRequest;

class KeyWordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKeyWordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKeyWordRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KeyWord  $keyWord
     * @return \Illuminate\Http\Response
     */
    public function show(KeyWord $keyWord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KeyWord  $keyWord
     * @return \Illuminate\Http\Response
     */
    public function edit(KeyWord $keyWord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKeyWordRequest  $request
     * @param  \App\Models\KeyWord  $keyWord
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKeyWordRequest $request, KeyWord $keyWord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KeyWord  $keyWord
     * @return \Illuminate\Http\Response
     */
    public function destroy(KeyWord $keyWord)
    {
        //
    }
}
