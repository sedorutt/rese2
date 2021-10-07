<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserve;
use Illuminate\Support\Facades\Validator;

class ReserveController extends Controller
{
    public function store($id, Request $request)
    {
        // Log::debug($request);
        if (!auth()->user()) {
            return redirect(route('login'));
        } else {
            $rules = [
                'reserved_date' => ['required', 'date','after:today'],
                'reserved_time' => ['required','in:'. implode(',', config('time.timeList'))],
                'number' => ['required', 'integer']
            ];

            $this->validate($request, $rules);

            $reserve = new Reserve();
            $reserve->user_id = auth()->id();
            $reserve->shop_id = $id;
            $reserve->reserved_date = date('y-m-d', strtotime($request->reserved_date));
            $reserve->reserved_time = date('H:i', strtotime($request->reserved_time));
            $reserve->number = $request->number;
            $reserve->save();

            return view('done');
        }
    }
    public function update(Request $request)
    {
        $rules = [
            'number' => ['required', 'integer']
        ];

        $this->validate($request, $rules);

        Reserve::where('id',$request->id)->update([
            // 'reserved_date'=>$request->reserved_date,
            // 'reserved_time'=>$request->reserved_time,
            'number'=>$request->number
        ]);

        return redirect(route('mypage'));

    }

    public function destroy($id)
    {
        Reserve::where('id',$id) -> delete();

        return redirect(route('mypage'));
    }
}
