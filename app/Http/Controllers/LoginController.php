<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //注册页面
    public function reg(){
        return view('Login/reg');
    }
    //发送手机号
    public function sends(){
        $tel=request()->tel;
        // dd($tel);
        $host = "http://dingxin.market.alicloudapi.com";
        $path = "/dx/sendSms";
        $method = "POST";
        $appcode = "b3fceac90f874ecb85fd4dbc89a210b1";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $rand=rand(100000,999999);
        $querys = "mobile=".$tel."&param=code%3A".$rand."&tpl_id=TP1711063";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $data=json_decode(curl_exec($curl),true);
        // dd($data['return_code']);
        if($data['return_code']==00000){
            $res=request()->session()->put('rand',$rand);
            return ['code'=>1,'msg'=>'验证码已发送'];
        }else{
            return ['code'=>0,'msg'=>'发送验证码失败'];
        }
    }
    //注册执行
    public function regdo(){
        $post=request()->except('_token','user_password');
        //dd($post);
        $res=DB::table('user')->insert($post);
        if($res){
            return redirect('Login/login');
        }
    }
    public function login(){
        return view('Login/login');
    }
    public function logindo(){
        $post=request()->except('_token');
        $data=DB::table('user')->first();
        //$data = json_encode($data);
        //dd($data);
        if($data->user_tel==$post["user_tel"]&&$data->user_pwd==$post["user_pwd"]){
            request()->session()->forget('user_id');
            request()->session()->put('user',['user_id'=>$post['user_tel']]);
            return redirect('/');
        }else{
            return '用户名或密码有误';
        }
    }
    public function test(){
        dump($res=request()->session()->all());
    }
}
