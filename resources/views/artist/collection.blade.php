@extends('ui.master')
@section('content')
@php 
$locate = \Session::get('locale');

$nameC = "";
if($locate=="vi") $nameC = "Bộ sưu tập mới nhất";
else if($locate=="en") $nameC = "Newest collection";
else if($locate=="fr") $nameC = "Nouvelle collection";

if($locate=="vi") $locate = "";
else $locate = "_".$locate;
@endphp
<div class="box-collection">
    <div class="box-content">
        <div class="collections">
            <h1>COLLECTIONS</h1>
            <button class="mobile-collection">COLLECTIONS <i class="fa fa-long-arrow-down"></i></button>
            <ul>
                @foreach($collections as $index => $item)
                <li><a href="{{ route("ui.collection.v3", ["collection_id"=>$item["id"]]) }}" @if($index==$default) class="active"  @endif>{{ $item["name".$locate] }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="detail-collection">
            <div class="detail">
                <h2 class="hover-title">{{ $collections[$default]["name".$locate] }}</h2>
                <div class="detail-content">
                    <div class="box-detail-content">
                        {{ $collections[$default]["description".$locate] }}
                    </div>
                </div>
                @foreach($post as $index => $item)
                <div @if($index==$postDefault) class="image active" @else class="image" @endif>
                    <a data-magnify="pc" href="/images/{{ $item["image"] }}" class="zoom"><i class="fa fa-expand"></i></a>
                    <img src="/images/{{ $item["image"] }}">
                    <div class="box-info">
                        <div class="info">
                            @if($locate == '_en')
                                DETAIL
                            @elseif($locate == '_fr')
                                DÉTAIL
                            @else
                                CHI TIẾT
                            @endif
                            <div class="info-content">
                                <p>
                                    @php 
                                    $ok = explode("\n", $item["description".$locate]);
                                    $ok = join("<br>", $ok);
                                    @endphp
                                    {!! $ok !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="list-collection">
            <div class="box-items">
                @foreach($post as $index => $item)
                <div onclick="chooseImage({{ $index }})" class="item">
                    <img src="/images/{{ $item["image"] }}">
                </div>
                @endforeach
            </div>
        </div>
        <div class="list-collection-mobile">
            <div class="box-active">
                @foreach($post as $index => $item)
                <div  @if($index==$postDefault) class="item active" @else class="item" @endif>
                    <a data-magnify="mobile" href="/images/{{ $item["image"] }}" class="zoom"><i class="fa fa-expand"></i></a>
                    <img src="/images/{{ $item["image"] }}">
                    <div class="box-info">
                        <div class="info">
                            @if($locate == '_en')
                                DETAIL
                            @elseif($locate == '_fr')
                                DÉTAIL
                            @else
                                CHI TIẾT
                            @endif
                            <div class="info-content">
                                <p>
                                    @php 
                                    $ok = explode("\n", $item["description".$locate]);
                                    $ok = join("<br>", $ok);
                                    @endphp
                                    {!! $ok !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="name-collection-mobile">
                {{ $collections[$default]["name".$locate] }}
            </div>
            <div class="owl-carousel owl-theme box-items">
                @foreach($post as $index => $item)
                <div class="item">
                    <img onclick="chooseImageMobile({{ $index }})" src="/images/{{ $item["image"] }}">
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="/owl2/owl.carousel.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", ()=>{
    var description = document.querySelector(".detail-collection .detail .detail-content");
    document.querySelector(".hover-title").onmouseover = ()=>description.classList.toggle("active");
    document.querySelector(".hover-title").onmouseout = ()=>description.classList.toggle("active");
})
</script>
<script>
document.addEventListener("DOMContentLoaded", ()=>{
    $('.owl-carousel.owl-theme.box-items').owlCarousel({
        loop: false,
        margin:10,
        nav: false,
        dots: false,
        responsive:{
            0:{
                items:4
            },
            600:{
                items:4
            },
            1000:{
                items:4
            }
        }
    });
});
</script>
<script>
// mobile menu collection
document.addEventListener("DOMContentLoaded", ()=>{
    var buttonCollection = document.querySelector("button.mobile-collection");
    var listCollection = document.querySelector(".collections ul");
    if(buttonCollection.offsetWidth > listCollection.offsetWidth){
        listCollection.style.width = buttonCollection.offsetWidth +1 +"px";
        buttonCollection.style.width = buttonCollection.offsetWidth +1 +"px";
    }else{
        buttonCollection.style.width= listCollection.offsetWidth+ 1 + "px";
        listCollection.style.width = listCollection.offsetWidth+ 1 +"px";
    }
    buttonCollection.onclick = ()=>listCollection.classList.toggle("active");

    // collecion
    var images = document.querySelectorAll(".box-content .list-collection .box-items .item img");
    var collectionBoxs = document.querySelectorAll(".box-content .list-collection .box-items .item");
    var stt = 0;
    for(var i=0; i<images.length; i++) collectionBoxs[i].style.height = images[i].offsetWidth + "px";
    //mobile colection
    var images = document.querySelectorAll(".box-content .list-collection-mobile .owl-carousel .item img");
    var collectionBoxs = document.querySelectorAll(".box-content .list-collection-mobile .owl-carousel .item");
    for(var i=0; i<images.length; i++) collectionBoxs[i].style.height = images[i].offsetWidth + "px";
});
</script>
<script>
    var stt = {{ $postDefault }};
    function chooseImage(index){
        var imageShow   = document.querySelectorAll(".box-content .detail-collection .image");
        imageShow[stt].classList.remove("active");
        imageShow[index].classList.add("active");
        stt = index;
    }
</script>
<script>
    var sttMobile = {{ $postDefault }};
    function chooseImageMobile(index, info){
        var imageShow   = document.querySelectorAll(".list-collection-mobile .box-active .item");
        imageShow[sttMobile].classList.remove("active");
        imageShow[index].classList.add("active");
        sttMobile = index;
    }
</script>
<script>
document.addEventListener("DOMContentLoaded", ()=>{
    $('[data-magnify=pc]').magnify({
      resizable: false,
      initMaximized: true,
      title	: false,
      headerToolbar: [
        'close'
      ],
    });
    $('[data-magnify=mobile]').magnify({
      resizable: false,
      initMaximized: true,
      title	: false,
      headerToolbar   : [
        'close'
      ],
    });
});
</script>
@endsection

@section('css')
<link type="text/css" rel="stylesheet" href="/owl2/assets/owl.carousel.min.css">
<style>
body#dark .box-collection .box-content, body#dark .box-collection .name-collection{
    background: #0a0a0e;
}
body#dark #wrapper{
    background: none;
}
body#dark .box-collection .box-content .list-collection .box-items .item img{
    border: 1px solid white;
}
body#dark .name-collection{
    color: white;
}
</style>
<style>

.magnify-modal {
    box-shadow: 0 0 6px 2px rgba(0, 0, 0, .3);
    background: #666666f5;
}

.magnify-header .magnify-toolbar {
    background-color: rgba(0, 0, 0, .5);
}

.magnify-stage {
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    border-width: 0;
}

.magnify-footer {
    bottom: 10px;
}

.magnify-footer .magnify-toolbar {
    background-color: rgba(0, 0, 0, .5);
    border-radius: 5px;
}

.magnify-loader {
    background-color: transparent;
}

.magnify-header,
.magnify-footer {
    pointer-events: none;
}

.magnify-button {
    pointer-events: auto;
}
</style>
<style>
::-webkit-scrollbar {
  width: 0px;
}
.box-zoom{
    display: none;
}
.box-zoom.show{
    display: block;
}
.box-collection{
    width: 100%;
    height: 100vh;
    padding: 70px 50px 50px 50px;
}
.box-collection .name-collection{
    background: white;
    font-size: 30px;
    padding-bottom: 5px;
}
.box-collection .box-content {
    background: white;
    height: 100%;
    width: 100%;
    display: flex;
    padding: 15px;
}
.box-collection .box-content .list-collection-mobile{
    display: none;
}
.box-collection .box-content .collections{
    background: #898C9D;
    width: 20%;
    text-align: left;
    padding: 15px;
}
.box-collection .box-content .collections h1{
    font-size: 28px;
    color: white;
    padding: 15px;
}
.box-collection .box-content .collections button{
    display: none;
}
.box-collection .box-content .collections ul{
    padding: 0px 15px;
}
.box-collection .box-content .collections ul li a{
    font-size: 14px;
    padding: 10px 0px;
    display: inline-block;
    color: white;
    border-bottom: 2px solid #898C9D;
}
.box-collection .box-content .collections ul li:first-child a::before{
    content: "{{ $nameC }}: "
}
.box-collection .box-content .collections ul li a.active, .box-collection .box-content .collections ul li a:hover{
    border-bottom: 2px solid white;
}
.box-collection .box-content .detail-collection{
    background: #898C9D;
    width: 30%;
    text-align: left;
    margin-left: 15px;
}
.box-collection .box-content .detail-collection button, .box-collection .box-content .detail-collection .zoom{
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
    margin-left: 15px;
    margin-top: 15px;
}
.box-collection .box-content .detail-collection button i{
    font-size: 14px;
    transition: 0.6s;
}
.box-collection .box-content .detail-collection button.active i{
    transform: rotate(-90deg);
}
.box-collection .box-content .detail-collection .detail{
    height: calc(100% - 60px);
    overflow: hidden;
    overflow-y: scroll;
    padding: 15px;
    position: relative;
}
.box-collection .box-content .detail-collection .detail h2{
    color: white;
    font-size: 25px;
    font-weight: 500;
    padding-bottom: 15px;
    border-bottom: 2px solid white;
    margin-bottom: 15px; 
    display: inline-block;
    cursor: pointer;
}
.box-collection .box-content .detail-collection .detail h2::before{
   content: "{{ $nameC }}: ";
   cursor: pointer;
   display: none;
}
.box-collection .box-content .detail-collection .detail .detail-content{
    position: absolute;
    width: calc(100% - 30px);
    top: 60px;
    left: 15px;
    background: #000000c7;
    z-index: 1;
    color: white;
    padding: 0px;
    font-size: 15px;
    line-height: 30px;
    text-align: justify;
    overflow: hidden;
    visibility: hidden;
    transition: 0.4s;
    opacity: 0;
    transform: scale(0.5);
}
.box-collection .box-content .detail-collection .detail .detail-content.active{
    display: block;
    opacity: 1;
    visibility: visible;
    transform: scale(1);
}
.box-collection .box-content .detail-collection .detail .detail-content .box-detail-content{
    margin: 15px;
}
.box-collection .box-content .detail-collection .detail .image{
    position: relative;
    display: none;
}
.box-collection .box-content .detail-collection .detail .image.active{
    display: block;
}
.box-collection .box-content .detail-collection .detail .image a.zoom{
    position: absolute;
    top: 15px;
    right: 15px;
    margin: 0px;
}
.box-collection .box-content .detail-collection .detail .image a.zoom i{
    transition: 0.4s;
    cursor: pointer;
}
.box-collection .box-content .detail-collection .detail .image a.zoom:hover i{
    transform: rotate(-45deg);
}
.box-collection .box-content .detail-collection .detail .image img{
    width: 100%;
}
.box-collection .box-content .detail-collection .detail .image .box-info{
    position: fixed;
    bottom: 78px;
}
.box-collection .box-content .detail-collection .detail .image .box-info .info{
    color: white;
    position: relative;
    font-size: 11px;
    cursor: pointer;
    transition: 1s;
    background-color: #898C9D;
    font-weight: 500;
}
.box-collection .box-content .detail-collection .detail .image .box-info .info:hover{
    text-decoration: underline;
}
.box-collection .box-content .detail-collection .detail .image .box-info .info .info-content{
    position: absolute;
    bottom: 45px;
    left: -1px;
    background: #000000c7;
    min-width: 200px;
    padding: 15px;
    z-index: 1000;
    font-size: 11px;
    opacity: 0;
    visibility: hidden;
    transition: 0.4s;
    transform: scale(0.5);
    color: white;
}
.box-collection .box-content .detail-collection .detail .image .box-info .info .info-content p{
    font-size: 11px;
    line-height: 30px;
}
.box-collection .box-content .detail-collection .detail .image .box-info .info:hover .info-content{
    opacity: 1;
    visibility: visible;
    transform: scale(1);
}
.box-collection .box-content .list-collection{
    width: 50%;
    height: 100%;
    overflow: hidden;
    overflow-y: scroll; 
}
.box-collection .box-content .list-collection .box-items{
    width: 100%;
    text-align: left;
    display: flex;
    flex-wrap: wrap;
}
.box-collection .box-content .list-collection .box-items .item{
    width: 25%;
    height: 200px;
    padding-left: 15px;
    padding-bottom: 15px;
    cursor: pointer;
}
.box-collection .box-content .list-collection .box-items .item img{
    object-fit: cover;
    width: 100%;
    height: 100%;
    padding: 10px;
    background: #898C9D;
    border: 1px solid black;
}
</style>
<style>
@media (max-width: 1199px){
    .box-collection .box-content .list-collection .box-items .item{
        width: 33.33%;
        height: ;
        padding-left: 15px;
        padding-bottom: 15px;
    }
}
</style>
<style>
@media (max-width:991px){
    a.fixed-title.toggle-mode.cursor-pt{
        display: none;
    }
    body#dark #wrapper{
        background: #0a0a0e;
    }
    #wrapper{
        background: white;
    }
    body#dark .name-collection-mobile{
        color: white;
    }
    .box-collection{
        padding: 0 15px;
    }
    .box-collection .name-collection{
        display: none;
    }
    .box-collection .box-content{
       flex-direction: column;
       padding: 0px;
       background: none;
    }
    .box-collection .box-content .collections,.box-collection .box-content .detail-collection, .box-collection .box-content .list-collection{
        width: 100%;
        margin: 0px;
    }
    .box-collection .box-content .collections{
        width: 100%;
        margin: 0px;
        background: none;
        position: fixed;
        top: 70px;
        right: 0px;
        z-index: 10;
    }
    .box-collection .box-content .collections h1{
        display: none;
    }
    .box-collection .box-content .collections button{
        display: inline-block;
        outline: none;
        border: none;
        padding: 15px;
        background: #000000d1;
        color: white;
        margin-left: 15px;
    }
    .box-collection .box-content .collections ul{
        background: #000000d1;
        margin: 15px;
        display: inline-block;
        position: absolute;
        left: 15px;
        top:55px;
    }
    .box-collection .box-content .collections ul li{
       height: 0px;
       overflow: hidden;
       transition: 0.6s;
    }
    .box-collection .box-content .collections ul li a{
        text-decoration: none;
        border: none;
        text-align: center;
        display: inline-block;
        width: 100%;
    }
    .box-collection .box-content .collections ul.active li{
       height: 38px;
    }
    .box-collection .box-content .collections ul li:first-child a::before{
        content: "";
    }
    .box-collection .box-content .detail-collection{
        padding-top: 110px;
    }
    .box-collection .box-content .detail-collection button{
        display: none;
    }
    .box-collection .box-content .detail-collection .detail .detail-content{
        position: relative;
        visibility: visible;
        opacity: 1;
        transform: scale(1.0);
        top: 0px;
        left: 0px;
        width: auto;
        background:none;
    }
    .box-collection .box-content .detail-collection .detail .detail-content .box-detail-content{
        margin: 0px;
    }
    .box-collection .box-content .detail-collection .detail{
        height: auto;
        overflow: none;
    }
    .box-collection .box-content .detail-collection .detail h2{
        padding-top: 15px;
    }
    .box-collection .box-content .detail-collection .detail h2::before{
        margin-right: 5px;
        content: "{{ $nameC }}: ";
        @if($collections[0]["id"]==$collections[$default]["id"])
        display: inline-block;
        @endif
    }
    .box-collection .box-content .detail-collection .detail .image{
        display: none;
    }
    .box-collection .box-content .detail-collection .detail .image.active{
        display: none;
    }
    .box-collection .box-content .list-collection{
        display: none;
    }
    .box-collection .box-content .list-collection-mobile{
        display: block;
        margin-top: 15px;
        padding-bottom: 65px;
    }
    .box-collection .box-content .list-collection-mobile .box-active{
        width: 100%;
        height: auto;
    }
    .box-collection .box-content .list-collection-mobile .box-active .item{
        display: none;
    }
    .box-collection .box-content .list-collection-mobile .box-active .item.active{
        display: block;
        position: relative;
    }
    .box-collection .box-content .list-collection-mobile .box-active .item.active a{
        position: absolute;
        right: 15px;
        top:15px;
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
    .box-collection .box-content .list-collection-mobile .box-active .item.active .box-info{
        position: absolute;
        bottom: 15px;
        left: 15px;
    }
    .box-collection .box-content .list-collection-mobile .box-active .item.active .box-info{
        position: absolute;
        bottom: 15px;
        left: 15px;
    }
    .box-collection .box-content .list-collection-mobile .box-active .item.active .box-info .info{
        position: relative;
        color: white;
        font-size: 14px;
    }
    .box-collection .box-content .list-collection-mobile .box-active .item.active .box-info .info .info-content{
        display: none;
    }
    .box-collection .box-content .list-collection-mobile .box-active .item.active .box-info .info:hover .info-content{
        display: block;
        position: absolute;
        bottom: 20px;
        left: 0px;
        min-width: 200px;
        background: #000000c7;
        padding: 15px;
    }
    .box-collection .box-content .list-collection-mobile .box-active .item.active .box-info .info:hover .info-content p{
        font-size: 11px;
        line-height: 30px;
    }
    .box-collection .box-content .list-collection-mobile .box-active img{
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    .box-collection .box-content .list-collection-mobile .name-collection-mobile{
       font-size: 18px;
       margin-top: 15px;
    }
    .box-collection .box-content .list-collection-mobile .box-items{
        margin-top: 15px;
    }
    .box-collection .box-content .list-collection-mobile .box-items .item{
        height: 70px;
    }
    .box-collection .box-content .list-collection-mobile .box-items .item img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
}
</style>
@endsection