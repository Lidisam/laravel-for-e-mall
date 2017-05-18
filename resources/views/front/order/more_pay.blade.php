@extends('front.layouts.base')

@section('title','更多支付方式')

@section('content')
    <header>
        <a href="javascript:self.location=document.referrer;" class="iconfont backIcon">&#60;</a>
        <h1>支付方式</h1>
    </header>
    <div style="height:1rem;"></div>
    <form action="{{ route('front.order.more_pay') }}" method="post">
        {!! csrf_field() !!}
        <ul class="userForm address-list">
            @if(count($data))
                @foreach($data as $k => $v)
                    <li>
                        <aside class="confirmAddr">
                            <label>
                            <span><input type="radio" class="check" name="pay_way" value="{{ $v->id }}"
                                         title="选择支付方式" {{ $k==0?'checked':'' }}></span>
                                <span>{{ $v->pay_name }}</span>
                            </label>
                        </aside>
                    </li>
                @endforeach
            @else
                <li style="text-align: center;color: #eeeeee">暂无支付方式，默认选择货到付款</li>
            @endif
        </ul>
        <div>
            <button type="submit" class="btn btn-success form-control">确定返回</button>
        </div>
    </form>

@stop
