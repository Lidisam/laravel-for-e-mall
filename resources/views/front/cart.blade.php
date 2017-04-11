@extends('front.layouts.base')

@section('title','首页')

@section('content')
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="/Front/images/icon/apple-touch-icon-57x57-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="/Front/images/icon/apple-touch-icon-120x120-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="196x196" href="/Front/images/icon/apple-touch-icon-196x196-precomposed.png">
<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" type="text/css" href="/Front/css/style.css" />
<script src="/Front/js/jquery.js"></script>
<script>
$(document).ready(function(){
  //show or hide:delBtn
  $(".edit").toggle(function(){
	  $(this).parent().siblings("dd").find(".delBtn").fadeIn();
	  $(this).html("完成");
	  $(".numberWidget").show();
	  $(".priceArea").hide();
	  },function(){
	  $(this).parent().siblings("dd").find(".delBtn").fadeOut();
	  $(this).html("编辑");
	  $(".numberWidget").hide();
	  $(".priceArea").show();
		  });
  //minus
  $(".minus").click(function(){
	  var currNum=$(this).siblings(".number");
	  if(currNum.val()<=1){
		  $(this).parents("dd").remove();
		  nullTips();
		  }else{
			  currNum.val(parseInt(currNum.val())-1);
			  }
	  });
  //plus
  $(".plus").click(function(){
	  var currNum=$(this).siblings(".number");
	  currNum.val(parseInt(currNum.val())+1);
	  });
  //delBtn
  $(".delBtn").click(function(){
	  $(this).parent().remove();
	  nullTips();
	  });
  //isNull->tips
  function nullTips(){
	  if($(".cart dd").length==0){
		  var tipsCont="<mark style='display:block;background:none;text-align:center;color:grey;'>购物车为空！</mark>"
		  $(".cart").remove();
		  $("body").append(tipsCont);
		  }
	  }
});
</script>

<!--header-->
<header>
 <a href="javascript:history.go(-1);" class="iconfont backIcon">&#60;</a>
 <h1>购物车</h1>
</header>
<div style="height:1rem;"></div>
<dl class="cart">
 <dt>
  <label><input type="checkbox"/>全选</label>
  <a class="edit">编辑</a>
 </dt>
 <dd>
  <input type="checkbox"/>
  <a href="product.html" class="goodsPic"><img src="/Front/upload/goods008.jpg"/></a>
  <div class="goodsInfor">
   <h2>
    <a href="product.html">新鲜小黄鱼特惠</a>
    <span>1</span>
   </h2>
   <div class="priceArea">
    <strong>0.00</strong>
    <del>0.00</del>
   </div>
   <div class="numberWidget">
    <input type="button" value="-" class="minus"/>
    <input type="text" value="1" disabled  class="number"/>
    <input type="button" value="+"  class="plus"/>
   </div>
  </div>
  <a class="delBtn">删除</a>
 </dd>
 <dd>
  <input type="checkbox"/>
  <a href="product.html" class="goodsPic"><img src="/Front/upload/goods009.jpg"/></a>
  <div class="goodsInfor">
   <h2>
    <a href="product.html">豆腐干2kg装</a>
    <span>1</span>
   </h2>
   <div class="priceArea">
    <strong>0.00</strong>
    <del>0.00</del>
   </div>
   <div class="numberWidget">
    <input type="button" value="-" class="minus"/>
    <input type="text" value="1" disabled class="number"/>
    <input type="button" value="+" class="plus"/>
   </div>
  </div>
  <a class="delBtn">删除</a>
 </dd>
 <dd>
  <input type="checkbox"/>
  <a href="product.html" class="goodsPic"><img src="/Front/upload/goods007.jpg"/></a>
  <div class="goodsInfor">
   <h2>
    <a href="product.html">优质牛肉特价</a>
    <span>1</span>
   </h2>
   <div class="priceArea">
    <strong>0.00</strong>
    <del>0.00</del>
   </div>
   <div class="numberWidget">
    <input type="button" value="-" class="minus"/>
    <input type="text" value="1" disabled  class="number"/>
    <input type="button" value="+" class="plus"/>
   </div>
  </div>
  <a class="delBtn">删除</a>
 </dd>
</dl>
<!--bottom nav-->
<div style="height:1rem;"></div>
<aside class="btmNav">
 <a>合计：￥0.00</a>
 <a href="confirm_order.html" style="background:#64ab5b;color:white;text-shadow:none;">立即下单</a>
 @stop
