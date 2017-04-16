@extends('front.layouts.base')

@section('title','首页')

@section('content')
    <script src="{{ asset('Front/js/address/index.js') }}"></script>
    <!--header-->
    <header>
        <a href="javascript:self.location=document.referrer;" class="iconfont backIcon">&#60;</a>
        <h1>我的地址</h1>
    </header>
    <div style="height:1rem;"></div>
    <div><a class="btn btn-default form-control" style="margin-top: 5px" href="{{ route('front.address.create') }}">添加地址</a></div>
    <ul class="userForm address-list">
        @if(count($user_address))
            @foreach($user_address as $k => $v)
                <li>
                    <aside class="confirmAddr">
                        <p>
                            <span><input type="radio" class="check" name="select" title="选择收获地址"
                                        {{ ($v->is_selected == 1)?'checked':'' }}></span>
                            <span>收货人：{{ $v->name }}</span>
                            <span>{{ $v->mobile }}</span>
                        </p>
                        <address>{{ $v->address }}</address>
                        <a about="{{ $v->id }}" href="{{ route('front.address.edit',['address_id'=>$v->id]) }}"
                           class="iconfont">&#60;</a>
                    </aside>
                </li>
            @endforeach
        @else
            <li style="text-align: center;color: #eeeeee">暂无收货地址，请添加</li>
        @endif
    </ul>
@stop
