@extends('ui.master')
@section('content')
    <?php $is_dark = \Session::get('is_dark'); ?>
    <?php $locate = \Session::get('locale');?>
    <div class="content-holder elem scale-bg2 transition3" id="<?php echo($is_dark ? "dark-mode" : "")?>">
            <div class="scroll-page-nav">
                <ul>
                    <li><a  href="#sec1"><span class="nav-indicator"></span></a></li>
                    <li><a  href="#sec2"><span class="nav-indicator"></span></a></li>
                    <li><a  href="#sec3"><span class="nav-indicator"></span></a></li>
                </ul>
            </div>
            <div class="content full-height">
                <section class="section-columns ct-section-column" id="sec1">
                    <div class="section-columns-img contact-column-img">
                        <div class="bg" style="background-image:url({{asset('images/'.($about_me['image_about'] ?? ''))}})" ></div>
                    </div>
                    <div class="section-columns-text contact-column-text" style="overflow-y: auto;">
                        <div class="custom-inner">
                            <div class="container">
                                
                                <ul class="project-details">
                                    <li><i class="fa fa-map-marker"></i><div class="pd-holder"><h5>{{ __('labels.address') }} : {{$info->address ?? ""}}</h5></div></li>
                                    <li><i class="fa fa-envelope"></i><div class="pd-holder"><h5>E-mail : {{$info->gmail ?? ""}}</h5></div></li>
                                    <li><i class="fa fa-phone"></i><div class="pd-holder"><h5>{{ __('labels.phone') }} : {{$info->phone_number ?? ""}}</h5></div></li>
                                </ul>
                                <div class="container contact-cnt">
                                    <h2 style="color:white;">{{ __('labels.write_us') }}</h2>
                                    <div class="separator" style="margin: 10px 0;"></div>
                                    <div id="contact-form">
                                        <form class="contact-form-cnt" method="post" action="{{route('contact.create')}}">
                                            @csrf
                                            <label for="name">{{ __('labels.name') }}</label>
                                            <input name="name" type="text" id="name"  class="inputForm2" onClick="this.select()" style="font-family: 'Raleway';">
                                            <label for="email">Email</label>
                                            <input name="email" type="text" id="email" onClick="this.select()" style="font-family: 'Raleway';">
                                            <label for="comments">{{ __('labels.message') }}</label>
                                            <textarea name="message" id="comments" onClick="this.select()" style="font-family: 'Raleway'; margin-bottom: 0;"></textarea>
                                            <input type="submit" class="send_message transition" id="submit" value="{{ __('labels.submit') }}" style="margin: 15px 0;"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="no-padding" id="sec2">
                    <div class="content">
                        <div class="inline-facts-holder">
                            <div class="inline-facts">
                                <h6><a href="{{$info['link_fb'] ?? ""}}">Facebook</a></h6>
                            </div>
                            <div class="inline-facts">
                                <h6><a href="{{$info['link_twitter'] ?? ""}}">Twitter</a></h6>
                            </div>
                            <div class="inline-facts">
                                <h6><a href="{{$info['link_instagram'] ?? ""}}">Instagram</a></h6>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="flat-form contact-flat-form" id="sec3">
                    <div class="map-box">
                        <div class="map-holder contact-map-holder">
                            <div  id="map" style="height: 100%; width: 100%;"></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script>
        function initMap() {
            const uluru = { lat: 16.432, lng: 107.577 };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 12,
                center: uluru,
            });
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
        }
    </script>
@endsection

@section('css')
<style>
#sec1 .project-details li i{
    color: white;
}
</style>    
@endsection