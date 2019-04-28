<?php
return [
    //应用ID,您的APPID。
    'app_id' => "2016092600603225",


    //商户私钥
    'merchant_private_key' => "MIIEpQIBAAKCAQEAz2L8gAduFLpBr8slXHVRJVhSJR1R78WHognNaEiKn2/ATmyemMcxj1zzSkx8pBJHGY+uT+irfmHUpmJfhjZ6bXsguCKAKZaZREzIbef3/jxIuxvO6zSpK8YgKPQPFAqgZO6DCPWBeXwFzea6x9bvmeNZt8xe23fciPphvzt3jPdqIjKsHLz5Yq0654HkZ4MAcc/gnhS1iLOjHXO/i4oK4/8jBdVCaI+jRw70gMUzMWURs5/BaMbLCuxXBuRNRakrOeGmnF8GAFRuEgFNq6hmNvq/I17Q9mFfWVYDZsiczoJyAV/3w2OXNPcaL3MCOQEx9xxHrywMHMuJRcWSCSbvQQIDAQABAoIBAQDBdCbyDvxC3ZQUtj19x/oQChlmgblDH1Hsd5RiqPiWzZnoDi7LeVTj1OMl9b93FY25bGxAIlyHIh9Jrg5JllwR8H+PBK/lG5SRP8bfrzmIsRdvYvtcMN119fVd/nxqR5djT5JwMwO6HVUUwxyM+hS7ynaQm1YJCAByzo2L458boKkF2xWNnR89xlun/Rt6wP0JBcJWTQ8U6hkrS0fgyj2IxoZqLPYJ4r8UyI3P9WxoN/Jami4xgqCly5XC3gWiKSUEOSAiH7ooHgh/STBHz9Moxopg8clXfo1RMRr/5OoEivTK3RwmMLIgsh/ps6iikEH+SwQRMkQFzBl4MOolnyoBAoGBAPiP+f3Di4dUL1CUMih5XsCu7ngud5Wkmm533o1GVKUbXgIjSK2egKX2fFOirC0tpVup4gg488rDBIUmoZ2DLFTuIaPYUxRPoH/0U/FN2lH+KkwCLF9oUmzEzxtY6bzs36ToZ7fKPhIzqkGjyvnXZzMQuWy1lb3Gj6n+USUD8JsRAoGBANWXmQWL5JFCHgglw8fsg88ookvaCbnzOAaFBMwcevFOxbKB3sgIW3MadGrHhZZxnHmRY7R/gmQAMos45P4qhw7fOcHhDM44+xT6nt2MHDSqEj0/LdPl0AObk7YK5/ypCqvXSwQnOPcPGegD1OnHJS2hYUM6A9RppY9YsoiluzExAoGACO2S+yx07I13jZtlGdMSNjWSVzrEDNn2uhUQJ17pV2zeOZFu4N2anVt3J8HmEVFcaSh29/ijuRq8JNQ4ZeH6S6qqBqqUgVxC1ZW/FiHHv74zYruJQHwMyd9f2Qmei6yuc8vtPcrD4/97FBSAC+1SxaDKKD91e3WQX3jFDWFQ2SECgYEAp/VI+EqUVwFl+kQwGzNKRwmN7hWr1lSCtuW86wBuUPj/jyp+1E92EiI4b4sr6iy2vgXtII+wKhDZrg70S0WH5NL2aRYear/1+P5HFLJLr8IZC5513A34MA4T7m/PEyieYpiuvbpWGjj+xyrUL21RN/uSLzocrtjQvtMhuUCR3dECgYEAklyRXAsOPl6ORV4EbFeKDgQSzclkoun652A2FSF8wJ5JTzCjzA+Bn692Vp3jMsVTnOJjQ1znT28mWxbC+5l2tCaw4s/AsEiH0QyBN4XciOE9hZ4ETjAfnWkgc+JU/J3NlVz3aieDYaOWFsi/jmC/HTuh5tdpwYa1pMteCtCA5cY=",


    //异步通知地址
    'notify_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",


    //同步跳转
    'return_url' => "http://www.laravela.com/returnpay",


    //编码格式
    'charset' => "UTF-8",


    //签名方式
    'sign_type'=>"RSA2",


    //支付宝网关
    'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",


    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAqFgDePsIIstGtwxEFzz6AWbIFxNDZF+OOiek+bUWA9ToIEuFgT9/iGr/SkMalGSV/oHw6dkXmP+5jjo2oupmDDVpodZRaQLuacpocxx24mK4bqVQYqfW8oHF80GfSedIteYxhonhTxEsi+g8HQRC5QhFusGGWqi3srqNHFXKcBh80LLq9IPDzyEz93jHO5gJD9qpWPq5w0XvB9KZaDYue/l3C+P4eb5JzlourJzSMbo4xLdAtdCgfo8L9S5mE4gto4pZvxxKBvjm/IgCy4I2jWkdEMU6BNH4HlELingJkL9TLbEg3Zaf7C3lJAxI0kiP45U58tz83SU/R7mXe0bDUQIDAQAB",
];