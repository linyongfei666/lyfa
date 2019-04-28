<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CartController extends Controller{
    public function cartlist(){
        $user = request()->session()->get('user');
        $goodsInfo = DB::table('user')->where('user_tel',$user['user_id'])->first();
        if($goodsInfo==''){
            return redirect('Login/login');
        }
        $user_id = $goodsInfo->user_id;
        $res=DB::table('cart')
            ->join('goods','goods.goods_id','=','cart.goods_id')
            ->where(['user_id'=>$user_id,'cart_status'=>1])
            ->get();
        //dd($res);
        return view('/cart/cartlist',['res'=>$res]);
    }
    public function cart(){
        $goods_id=request()->goods_id;
        $where=[
            'goods_id'=>$goods_id
        ];
        $data=DB::table('goods')->where($where)->get();
        return view('cart/cart',['data'=>$data]);
    }
    /** 加入购物车 */
    public function addcart(){
        $goods_id = request()->goods_id;
        $buy_number = request()->buy_number;
        //dd($goods_id);
        $goodsWhere = [
            'goods_id' => $goods_id,
            'is_up' => 1
        ];
        $goodsInfo = DB::table('goods')->where($goodsWhere)->first();
        $user = request()->session()->get('user');
        $goodsInfo = DB::table('user')->where('user_tel',$user['user_id'])->first();
        //dd($goodsInfo);
        $user_id = $goodsInfo->user_id;
        $info = [
            'goods_id' => $goods_id,
            'buy_number' => $buy_number,
            'user_id'=>$user_id
        ];
        $res = DB::table('cart')->insert($info);
        if ($res) {
            return ['code' => 1, 'res' => '加入购物车成功'];
        } else {
            return ['code' => 0, 'res' => '加入购物车失败'];
        }


    }
    /** 获取商品总价*/
    public function countTotal(){
        $goods_id=request()->goods_id;
        $goods_id=explode(',',$goods_id);
        $user = request()->session()->get('user');
        $goodsInfo = DB::table('user')->where('user_tel',$user['user_id'])->first();
        $user_id = $goodsInfo->user_id;
        $where=[
            ['is_up','=',1],
            ['user_id','=',$user_id]
        ];
        $info=DB::table('cart as c')
            ->select('buy_number','self_price')
            ->join("goods as g",'c.goods_id','=','g.goods_id')
            ->where($where)
            ->whereIn('c.goods_id',$goods_id)
            ->get();
        $count=0;
        foreach($info as $k=>$v){
            $count+=$v->self_price*$v->buy_number;
        }
        return $count;
    }
    /**获取商品小计*/
    public function getSubTotal(){
        $goods_id=request()->goods_id;
        if(empty($goods_id)){
            return 0;exit;
        }
        $goodsWhere=[
            ['is_up','=',1],
            ['goods_id','=',$goods_id]
        ];
        $self_price=DB::table('goods')->where($goodsWhere)->value('self_price');
        //获取商品购买数量
        $user = request()->session()->get('user');
        $goodsInfo = DB::table('user')->where('user_tel',$user['user_id'])->first();
        $user_id = $goodsInfo->user_id;
        $cartWhere=[
            ['goods_id','=',$goods_id],
            ['user_id','=',$user_id]
        ];
        $buy_number=DB::table('cart')->where($cartWhere)->value('buy_number');
        return $self_price*$buy_number;
    }
    /** 更改购买数量*/
    public function changeBuyNumber(){
        $goods_id=request()->goods_id;
        $buy_number=request()->buy_number;
        $res=$this->checkGoodsNumber($goods_id,$buy_number);
        if($res){
            $user = request()->session()->get('user');
            $goodsInfo = DB::table('user')->where('user_tel',$user['user_id'])->first();
            $user_id = $goodsInfo->user_id;
            $where=[
                'goods_id'=>$goods_id,
                'user_id'=>$user_id
            ];
            $updateInfo=[
                'buy_number'=>$buy_number,
                'update_time'=>time()
            ];
            $result=DB::table('cart')->where($where)->update($updateInfo);

            if($result){
                return ['code' => 1, 'res' => '修改数量成功'];
            }else{
                return ['code' => 0, 'res' => '修改数量失败'];
            }
        }else{
            return ['code' => 0, 'res' => '购买数量超过了库存'];
        }
    }
    /** 检测库存*/
    public function checkGoodsNumber($goods_id,$buy_numer,$number=0){
        //根据商品id 查询商品库存
        $goods_num=DB::table('goods')->where("goods_id",$goods_id)->value("goods_num");
        if($buy_numer+$number>$goods_num){
            return false;
        }else{
            return true;
        }
    }
    
}
