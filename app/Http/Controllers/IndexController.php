<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res=DB::table('user')->get();
        $data=DB::table('goods')->get();
        $cate=DB::table('category')->where('pid',0)->get();
        return view('Index/index',['data'=>$data,'res'=>$res,'cate'=>$cate]);
    }
}