@extends('layouts.app')
@push('plugin-styles')
    <style>

    </style>
@endpush


@section('content')
<div class="container" style="margin: 0 auto;">
    {{-- bot container --}}
    <div style="max-width: 360px; background: #fff; border-radius: 10px; border: 1px solid  #334155;">
        {{-- top area --}}
        <div style="display: flex; justify-content: space-between; align-items:center; background: rgba(52, 53, 62, 0.425); border-top-left-radius: 10px; border-top-right-radius: 10px;">
            <div style="display: flex; gap: 10px; padding: 10px 12px 10px 12px">
                <div>
                    <img src="{{asset('images/bot.png')}}" alt="bot" style="width: 50px; height: 50px">
                </div>
                <div>
                    <p>peter</p>
                    <p>Agent <span>(online)</span></p>
                </div>
            </div>
            <div>X</div>
        </div>
        
        {{-- top area --}}

        <div style="height: 200px; background: #fff">

        </div>

        <div style="padding: 10px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; background: rgba(52, 53, 62, 0.105);">
            <input type="text" name="" id="">
        </div>

    </div>
    {{-- bot container --}}

</div>
@endsection
