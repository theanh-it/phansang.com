<div class="share-container  isShare" data-share="['facebook','pinterest','googleplus','twitter','linkedin']"></div>
</div>
<div id="<?php echo($is_dark ? "dark-mode" : "")?>" class="left-decor"></div>
<div id="<?php echo($is_dark ? "dark-mode" : "")?>" class="right-decor"></div>
<footer id="<?php echo($is_dark ? "dark-mode" : "")?>">
    <div class="footer-container">
        <div class="policy-box"></div>
        <div class="utilities-container">
            <a href="{{ url('switch-mode') }}"><i class="footer-icon"></i></a>
            <div class="language-container">
                <ul class="language-list">
                    <?php $locate = \Session::get('locale');?>
                    <li class="language-list-item"><a href="{{ url('locale/en') }}"
                                                      class="<?php echo($locate == 'en' ? "active" : "")?>">EN</a></li>
                    <li class="language-list-item"><a href="{{ url('locale/vi') }}"
                                                      class="<?php echo($locate == 'vi' || is_null($locate) ? "active" : "")?>">VN</a>
                    </li>
                    <li class="language-list-item"><a href="{{ url('locale/fr') }}"
                        class="<?php echo($locate == 'fr' ? "active" : "")?>">FR</a></li>
                </ul>
            </div>
            <div class="footer-social">
                <ul>
                    <li><a href="{{$info['link_fb'] ?? ""}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="{{$info['link_twitter'] ?? ""}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="{{$info['link_instagram'] ?? ""}}" target="_blank"><i class="fa fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="to-top"><i class="fa fa-angle-up"></i></div>
    </div>
</footer></div>
<script type="text/javascript" src="{{asset('ui/js/jquery.min.js')."?v=".time()}}"></script>
<script type="text/javascript" src="{{asset('ui/js/plugins.js')."?v=".time()}}"></script>
<script type="text/javascript" src="{{asset('ui/js/scripts.js')."?v=".time()}}"></script>
<script type="text/javascript" src="{{asset('ui/js/bup.js')."?v=".time()}}"></script>
<script type="text/javascript" src="{{asset('ui/js/jquery.magnify.js')."?v=".time()}}"></script>
<script>
    var appSettings = {
        locate: "{{ $locate }}",
        isDark: "{{ $is_dark }}",
    };
</script>
<script type="text/javascript" src="{{asset('ui/js/test.js')."?v=".time()}}"></script>
<script type="text/javascript" src="{{asset('ui/js/custom.js')."?v=".time()}}"></script>
@yield('js')
</body>
</html>
