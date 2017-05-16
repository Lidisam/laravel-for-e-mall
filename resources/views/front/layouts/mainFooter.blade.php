<div style="height:1.2rem;"></div>
<nav>
    <a href="/" class="homeIcon">首页</a>
    <a href="{{ route('front.cart.index') }}" class="categoryIcon">分类</a>
    <a href="{{ route('front.cart.index') }}" class="cartIcon">购物车</a>
    <a href="{{ route('front.user.index') }}" class="userIcon">我的</a>
</nav>
<script>
    document.oncontextmenu = new Function("event.returnValue=false;");
    document.onselectstart = new Function("event.returnValue=false;");
</script>
