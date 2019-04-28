<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class GoodsController extends Controller
{
    public function goodslist(){
        $data = cache('value');
        //dd($data);
        if(!$data){
            echo 111;
            $data=DB::table('goods')->get();
            cache(['value' => $data],24*60);
        }
        return view('goods/goodslist',['data'=>$data]);
    }
}
