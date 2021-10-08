<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Models\Shop;

class ShopController extends Controller
{
    public function store(Request $request)
    {
        if($request->has('shop')){
            $shop = new Shop();
            $shop->name = $request->name;
            $shop->image = $request->image;
            $shop->content = $request->content;
            $shop->genre_id = $request->genre_id;
            $shop->area_id = $request->area_id;
            $shop->save();
        }

        if($request->has('genre')){
            $genre = new Genre();
            $genre->genre = $request->registerGenre;
            $genre->save();
        }
        
        if($request->has('area')){
            $area = new Area();
            $area->area = $request->registerArea;
            $area->save();
        }

        return redirect(route('home'));
    }
}
