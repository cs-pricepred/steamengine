<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Skin;
use App\Models\Weapon;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Cache;
use SteamApi\Configs\Apps;
use SteamApi\SteamApi;

class SkinController extends Controller {
    /**
     * @return array
     */
    public function saleHistory(String $market_hash_name): array  {
        $cacheKey = 'saleHistory-' . $market_hash_name;

        $value = Cache::remember($cacheKey, 60*10, function() use ($market_hash_name) {
            $api = new SteamApi();
            /* $options = [ */
            /*     'market_hash_name' => "AK-47 | Jaguar (Factory New)" */
            /* ]; */
            $options = ['market_hash_name' => $market_hash_name];

            $items = $api->getSaleHistory(Apps::CSGO_ID, $options);

            /* if (is_array($items)) { */
            /*     return array_map(function($i){ */
            /*         $i['time'] = date('d.m.Y', $i['time']); */
            /*         return $i; */
            /*     }, $items); */
            /* } */

            return $items;
        });

        return $value;
    }

    public function show(string $id): View {
        $skin = Skin::find($id);
        $weapon = Weapon::find($skin->weapon_id);
        $market_hash = $weapon->name . ' | ' . $skin->name . ' (' . $skin->wear . ')';
        return view('skins.single', ['skin' => $skin, 'saleHistory'  => $this->saleHistory($market_hash), 'weapon' => $weapon]);
    }

    public function create(Request $request): Redirector|RedirectResponse {
        $validated = $request->validate([
            'weapon_id' => ['required', 'numeric'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        dump($validated);
        $skin = new Skin();

        $skin->name = $validated['name'];
        $skin->weapon_id = $validated['weapon_id'];
        $skin->wear = 'Minimal Wear';
        $skin->rarity = 'purple';
        $skin->stattrak = false;

        $skin->save();

        return redirect()->route('weapons.index');
    }
}
