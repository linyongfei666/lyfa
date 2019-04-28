<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class GoodssController extends Controller
{
    public function goodssadd(){
        return view('goodss/goodssadd');
    }
    // //上传图片
    public function upload(Request $request,$file){
        $photo = $request->file($file);
        $extension = $photo->extension();
        $store_result = $photo->storeAs('img', date("Ymd").rand(100,999).'.'.$extension);
        return $store_result;      
    }
    public function goodssadddo(Request $request){
        $post=$request->except('_token');
        // dd($post);
        if ($request->hasFile('goods_img')) {
            $post['goods_img']=$this->upload($request,'goods_img');
        }
        $res=DB::table('goodss')->insert($post);
        if($res){
            return redirect('/goodsslist');
        }
    }
    //列表页
    public function goodsslist(){
        $goods_name=request()->input('goods_name')?request()->input('goods_name'):'';
        $desc=request()->input('desc')?request()->input('desc'):'';
        $where=[];
        if($goods_name){
            $where[]=['goods_name','like',"%$goods_name%"];
        }
        $where1=[];
        if($desc){
            $where1[]=['desc','like',"%$desc%"];
        }
        $res=DB::table('goodss')->where($where)->where($where1)->paginate(3);
        return view('goodss/goodsslist',['res'=>$res,'goods_name'=>$goods_name,'desc'=>$desc]);
    }
    //详情页
    public function list($id){
        $where=[
            'id'=>$id
        ];
        $res=cache('res'.$id);
        //$res=false;
        if(!$res){
            echo 111;
            $res=DB::table('goodss')->where($where)->first();
            cache(['res'.$id=>$res],24*60);
        }
        //dd($res);
        return view('goodss/list',['res'=>$res]);
    }
    //删除
    public function del($id){
        $where=[
            'id'=>$id
        ];
        $res=DB::table('goodss')->where($where)->delete();
        cache(['res'.$id=>''],0);
        if($res){
            return redirect('/goodsslist');
        }
    }
    //修改
    public function goodssupdate($id){
        $where=[
            'id'=>$id
        ];
        $res=DB::table('goodss')->where($where)->first();
        return view('goodss/goodssupdate',['res'=>$res]);
    }
    //修改执行
    public function update(){
        $id=request()->id;
        $post=request()->except('_token');
        $where=[
            'id'=>$post['id']
        ];
        if (request()->hasFile('goods_img')) {
            $post['goods_img']=$this->upload(request(),'goods_img');
        }
        DB::table('goodss')->where($where)->update($post);
        $res=DB::table('goodss')->where($where)->first();
        cache(['res'.$id=>$res],24*60);
            return redirect('/goodsslist'); 
    }
}