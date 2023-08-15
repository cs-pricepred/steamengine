<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeaponCase;

class WeaponCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $cases = WeaponCase::all();

        return view('weaponcases.index', ['cases' => $cases]);
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
    public function show(string $name) {
        $case = WeaponCase::firstWhere('name', $name);

        return view('weaponcases.single', [
            'case' => $case,
            'saleHistory' => $case->historicSales()->get(),
        ]);
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
