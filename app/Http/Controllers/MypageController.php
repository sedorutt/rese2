<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use App\Models\Favorite;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $books = Reserve::with('shop')->where('user_id',auth()->id())->get();

        $favorite = Favorite::with('shop')->where('user_id', auth()->id())->get();
        $times = [
            '11:00:00' => '11:00:00',
            '11:30:00' => '11:30:00',
            '12:00:00' => '12:00:00',
            '12:30:00' => '12:30:00',
            '13:00:00' => '13:00:00',
            '13:30:00' => '13:30:00',
            '14:00:00' => '14:00:00',
            '14:30:00' => '14:30:00',
            '15:00:00' => '15:00:00',
            '15:30:00' => '15:30:00',
            '16:00:00' => '16:00:00',
            '16:30:00' => '16:30:00',
            '17:00:00' => '17:00:00',
            '17:30:00' => '17:30:00',
            '18:00:00' => '18:00:00',
            '18:30:00' => '18:30:00',
            '19:00:00' => '19:00:00',
            '19:30:00' => '19:30:00',
            '20:00:00' => '20:00:00',
            '20:30:00' => '20:30:00',
            '21:00:00' => '21:00:00',
            '21:30:00' => '21:30:00',
            '22:00:00' => '22:00:00',
            '22:30:00' => '22:30:00',
            '23:00:00' => '23:00:00',
        ];

        return view('mypage',compact('user','books','favorite','times'));
    }
}
