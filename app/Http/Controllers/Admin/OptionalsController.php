<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Optional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;

class OptionalsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $optionals = Optional::orderBy('name')->get();
        return view('optionals.index', compact('optionals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('optionals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $newOptional = new Optional();
        $newOptional->name = $data['name'];
        $newOptional->description = $data['description'];
        $newOptional->save();

        return Redirect::route('cars-settings.optionals.index');
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
    public function edit(Optional $optional)
    {
        return view('optionals.edit', compact('optional'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Optional $optional)
    {
        $data = $request->all();
        $optional->name = $data['name'];
        $optional->description = $data['description'];
        $optional->update();

        return Redirect::route('cars-settings.optionals.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Optional $optional)
    {
        if ($optional->cars()->exists()) {
            return Redirect::route('cars-settings.optionals.index')
                ->with('error', 'Cannot delete this optional0 because it is associated with one or more cars.');
        }
        $optional->delete();
        return Redirect::route('cars-settings.optionals.index');
    }
}
