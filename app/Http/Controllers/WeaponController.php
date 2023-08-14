<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Weapon;
use App\Models\Skin;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;

class WeaponController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return View|Factory
     */
    public function index(Request $request): View|Factory {
        $types = ['knife', 'glove', 'pistol', 'smg', 'heavy', 'rifle'];
        return view('weapons.index', ['weapons' => Weapon::all(), 'types' => $types]);
    }

    /**
     * Show the form for creating a new resource.
     * @return void
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @return void
     */
    public function store(Request $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     * @return void
     */
    public function show(string $id): View {
        $w = Weapon::find($id);
        return view('weapons.single', ['weapon' => $w, 'skins' => $w->skins()->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     * @return void
     */
    public function edit(string $id): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @return void
     */
    public function update(Request $request, string $id): Redirector|RedirectResponse|View {
        /* $request->validate([ */
        /*     'id' => ['required', 'number'], */
        /*     'type' => [], */
        /* ]); */

        $weapon = Weapon::find($id);
        $weapon->type = $request->type;
        $weapon->save();

        if ($request->hasHeader('HX-Request')) {
            $types = ['knife', 'glove', 'pistol', 'smg', 'heavy', 'rifle'];
            return view('components.forms.weapon-select', ['w' => $weapon, 'types' => $types]);
        }

        return redirect()->route('weapons.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return void
     */
    public function destroy(string $id): void
    {
        //
    }
}
