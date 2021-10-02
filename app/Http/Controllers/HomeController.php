<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Genre;
use Illuminate\Http\Request;
use App\Models\Shop;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $searchArea = $request->input('searchArea');
        $searchGenre = $request->input('searchGenre');
        $searchKeyword = $request->input('searchKeyword');

        $query = Shop::query();

        $shops = Shop::with(['area', 'genre','favorite'])
            ->when(!empty($searchArea), function ($query) use ($searchArea) {
                return $query->where('area_id', $searchArea);
            })
            ->when(!empty($searchGenre), function ($query) use ($searchGenre) {
                return $query->where('genre_id', $searchGenre);
            })
            ->when(!empty($searchKeyword), function ($query) use ($searchKeyword) {
                return $query->where('name','like','%'.$searchKeyword. '%')->orwhere('content','like','%'.$searchKeyword. '%');
            })->get();
        if(auth()->id()==1){
            $genres = Genre::all();
            $areas = Area::all();

            return view('home',compact(['shops','genres','areas']));
        }else{

            return view('home' ,compact('shops'));
        }
        
        

    }
    
}
