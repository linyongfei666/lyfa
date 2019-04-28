<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BayController extends Controller
{
    public function bay(){
        $goods_id=request()->goods_id;
        // dd($goods_id);
        $goods_id=explode(',',$goods_id);
        $user=request()->session()->get('user');
        $goodsInfo = DB::table('user')->where('user_tel',$user['user_id'])->first();
        $user_id = $goodsInfo->user_id;
        $res=DB::table('cart')
            ->join('goods','goods.goods_id','=','cart.goods_id')
            ->where(['user_id'=>$user_id,'cart_status'=>1])
            ->whereIn('cart.goods_id',$goods_id)
            ->get();
            //查询收货地址
        $user=request()->session()->get('user');
        $goodsInfo = DB::table('user')->where('user_tel',$user['user_id'])->first();
        $user_id = $goodsInfo->user_id;
        $address=DB::table('address')->where(['user_id'=>$user_id])->get();
        $price=0;
        foreach ($res as $k => $v){
            $res[$k]->zongjia=$res[$k]->self_price*$res[$k]->buy_number;
            $price+=$res[$k]->zongjia;
        }
        return view('bay/bay',['res'=>$res,'price'=>$price]);
    }
   //收货地址
    public function address(){
        //查询省份
        $provinceInfo=$this->getAreaInfo(0);
        // $users = DB::table('address')->where('address_name', '蔺永飞')->pluck('address_name');
        // dd($users);
        return view('bay/address',['provinceInfo'=>$provinceInfo]);
    }
    //查询地区
    public function getAreaInfo($pid){
        $where=[
            ['pid','=',$pid],
        ];
        $areaInfo=DB::table('area')->where($where)->get();
        if(!empty($areaInfo)){
            return $areaInfo;
        }else{
            return false;
        }
    }
    //获取地区
    public function getArea(){
        $id=request()->id;
        $areaInfo=$this->getAreaInfo($id);
        //print_r($areaInfo);die;
        if(!empty($areaInfo)){
            return json_encode($areaInfo);
        }
    }
    //添加收货地址
    public function addressDo(){
        $data=request()->all();
        if($data['is_default']==2){
            $user=request()->session()->get('user');
            $goodsInfo = DB::table('user')->where('user_tel',$user['user_id'])->first();
            $user_id = $goodsInfo->user_id;
            //dd($user_id);
            DB::table('address')->where('user_id',$user_id)->update(['is_default'=>1]);
        }
        $res=DB::table('address')->insert($data);
        if ($res) {
            return ['code' => 1, 'res' => ''];
        } else {
            return ['code' => 0, 'res' => ''];
        }
    }
    public function success($id){
        $config = config('alipay');
        //dd($config);
        $path = base_path();
        include_once $path."/app/libs/alipay/pagepay/service/AlipayTradeService.php";
        include_once $path."/app/libs/alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php";
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = '20190403'.rand(100,999);
        // dd($out_trade_no);
        //订单名称，必填
        $subject = '蔺永飞';
        //付款金额，必填
        $total_amount = $id;
        //商品描述，可空
        $body = '2013';
        //构造参数
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);
        $aop = new \AlipayTradeService($config);


        /**
         * pagePay 电脑网站支付请求
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @param $return_url 同步跳转地址，公网可以访问
         * @param $notify_url 异步通知地址，公网可以访问
         * @return $response 支付宝返回的信息
         */
        $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);
        //输出表单
        var_dump($response);
    }
    public function returnpay(){
        dump($_GET);
        $where['order_no']=htmlspecialchars($_GET['out_trade_no']);
        $where['order_amount']=htmlspecialchars($_GET['total_amount']);
        $count=DB::table('order')->where($where)->count();
         //检测价格 单号是否在数据库中
         if(!$count){
            //写入log日志
            Log::channel('alipay')->info('订单单号和价格不符，没有当前记录'.$result."支付宝交易号：".$trade_no);
        }
        //检测商户id是否相等     应用appid
        // if(htmlspecialchars($_GET['seller_id'])!=config('alipaypage.seller_id') || htmlspecialchars($_GET['app_id'])!=config('alipaypage.app_id')){
        //     Log::channel('alipay')->info('商品不符'.$result."支付宝交易号：".$trade_no);
        // }
        die;
    }
    
}
