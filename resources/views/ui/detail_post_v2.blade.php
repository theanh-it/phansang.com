@extends('ui.master')
<?php $locate = \Session::get('locale');?>
@section('content')
<div class="box-detail-post">
    <div class="box-img-detail">
        <div class="name-detail-post">
            @if($locate == 'en')
                {{$post['name_en'] ? $post['name_en'] : $collection['name_en']}}
            @elseif($locate == 'fr')
                {{$post['name_fr'] ? $post['name_fr'] : $collection['name_fr']}}
            @else
                {{$post['name'] ? $post['name'] : $collection['name']}}
            @endif
        </div>
        <div class="image">
            <img class="img-post" src="{{ asset('images/'.($post['image'] ?? "")) }}" alt="">
            <a data-magnify="full" href="{{ asset('images/'.($post['image'] ?? "")) }}" class="zoom"><i class="fa fa-expand"></i></a>
        </div>
    </div>
    <div class="detail-imgbox">
        <div class="info-post">
            @if($locate == 'en')
                DETAIL
            @elseif($locate == 'fr')
                DÉTAIL
            @else
                CHI TIẾT
            @endif
        </div>
        @if($locate == 'en')
            <p>{!! nl2br(e($post['detail_en'] ?? ""))!!}</p>
        @elseif($locate == 'fr')
            <p>{!! nl2br(e($post['detail_fr'] ?? ""))!!}</p>
        @else
            <p>{!! nl2br(e($post['detail'] ?? ""))!!}</p>
        @endif
    </div>
</div>
@endsection

@section('js')
<script>
    document.addEventListener("DOMContentLoaded",()=>{
        var img = document.querySelector("div.box-detail-post .box-img-detail .img-post");
        var detail = document.querySelector("div.box-detail-post .detail-imgbox");
        detail.style.width = img.offsetWidth+"px";
    })
</script>
<script>
    document.addEventListener("DOMContentLoaded", ()=>{
        $('[data-magnify=full]').magnify({
          resizable: false,
          initMaximized: true,
          title	: false,
          headerToolbar: [
            'close'
          ],
        });
    });
</script>
@endsection

@section('css')
<style>
.box-detail-post{  
    background: white;
    width: calc(100vw - 100px);
    height: 100vh;
    padding: 70px 50px 50px 50px;
    margin: auto;
    overflow: hidden;
    overflow-y: scroll;
    font-size: 14px;
}
.box-detail-post .box-img-detail .image{  
   position: relative;
   display: inline-block;
}
.box-detail-post .box-img-detail a{  
    position: absolute;
    top: 30px;
    right: 30px;
    cursor: pointer;
    outline: none;
    border: none;
    background: #000000c7;
    height: 30px;
    width: 30px;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
}
.box-detail-post .img-post{
    width: auto;
    max-width: 100%;
    padding-bottom: 50px;
    border-bottom: 1px solid black;
   
}

.box-detail-post .name-detail-post{
    padding: 50px;
    font-size: 3.2em;
    font-weight: 300;
    text-transform: uppercase;
}
.box-detail-post .detail-imgbox{
    margin: 0 auto;
    line-height: 2;
    text-align: left;
    padding-bottom: 50px;
}
.box-detail-post .detail-imgbox .info-post{
    padding-top: 30px;
    font-size: 2.2em;
    font-weight: 300;
    text-transform: uppercase;
}
@media (max-width:768px){
.box-detail-post .name-detail-post {
    padding: 50px;
    font-size: 2.5em;
    font-weight: 300;
    text-transform: uppercase;
}
}
@media (max-width:425px){
    .box-detail-post{
        padding: 70px 15px 15px 15px;
        width: 100%;
    }
.box-detail-post .name-detail-post {
    padding: 20px 5px;
    font-size: 2.5em;
    font-weight: 300;
    text-transform: uppercase;
}
.box-detail-post .img-post {
    width: auto;
    max-width: 100%;
    padding-bottom: 50px;
}
}
</style>
@endsection