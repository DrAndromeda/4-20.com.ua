<?php  return array (
  0 => 
  array (
    'modChunk_id' => '20',
    'modChunk_source' => '1',
    'modChunk_property_preprocess' => '0',
    'modChunk_name' => 'js',
    'modChunk_description' => '',
    'modChunk_editor_type' => '0',
    'modChunk_category' => '0',
    'modChunk_cache_type' => '0',
    'modChunk_snippet' => '<script src="/assets/js/jquery-1.11.0.min.js"></script>
<script src="/assets/js/countdown.js"></script>
<!--script type="text/javascript" src="/assets/js/jquery.js"></script !-->
<script src="/assets/js/sliderf.js"></script>
<script src="/assets/js/jquery.cycle2.min.js"></script>
<script src="/assets/js/script.js"></script>
<script src="/assets/js/jquery.validate.min.js"></script>
<script src="/assets/js/jquery.easyModal.js"></script>
<script src="/assets/js/main.js"></script>
<!-- <script>
var cb1 = function() {
var l = document.createElement(\'link\'); l.rel = \'stylesheet\';
l.href = \'/assets/css/slick.css\';
var h = document.getElementsByTagName(\'head\')[0]; h.parentNode.insertBefore(l, h);
};
var cb2 = function() {
var l = document.createElement(\'link\'); l.rel = \'stylesheet\';
l.href = \'/assets/css/style.css\';
var h = document.getElementsByTagName(\'head\')[0]; h.parentNode.insertBefore(l, h);
};
var raf = requestAnimationFrame || mozRequestAnimationFrame ||
webkitRequestAnimationFrame || msRequestAnimationFrame;
if (raf) {
	raf(cb1);
	raf(cb2);
}
else {
window.addEventListener(\'load\', cb1);
window.addEventListener(\'load\', cb2);
}
</script> !-->

<script>
    $(document).ready(function(){
	//remove it tomorrow
	$(".row-main .table-value").removeClass("active");
//actions block slider
        if ($(window).width()<785 || is_ios){
            $(".actions_block .container").slick({
                infinite: true,
                slidesToShow: 1,
            });
        }
//why block randomize viewing mechanics
        if ($(\'.why_teach\').length) {
            var card = [1, 2, 3, 4, 5, 6, 7, 8, 9,];
            for (var i=0; i<3; i++) {
                var rand = Math.floor(Math.random()*card.length);
                card.splice(rand, 1);
            }
            for (var i=card.length; i>0; i--) {
                $(\'.why_teach .element:nth-child(\'+card[i-1]+\')\').remove();
            }
            $(\'.element\').removeClass(\'element_disabled\');
        }
//why block slider
        if ($(window).width()<785 || is_ios){
            $(".why_teach .container").slick({
                infinite: true,
                slidesToShow: 1,
            });
        }

        $(\'#test_ch_1\').on(\'click\', function(e){
            $(\'.container-main>*\').removeClass(\'active\');
            $(\'.form_stage2\').addClass(\'active\');
            e.preventDefault();
        });
        $(\'#test_ch_2\').on(\'click\', function(e){
            $(\'.container-main>*\').removeClass(\'active\');
            $(\'.form_stage3\').addClass(\'active\');
            e.preventDefault();
        });
        $(\'#test_ch_3\').on(\'click\', function(e){
            $(\'.container-main>*\').removeClass(\'active\');
            $(\'.form_stage4\').addClass(\'active\');
            e.preventDefault();
        });
        $(\'#test_ch_4\').on(\'click\', function(e){
            $(\'.container-main>*\').removeClass(\'active\');
            $(\'.form_stage5\').addClass(\'active\');
            e.preventDefault();
        });
        $(\'#test_ch_5\').on(\'click\', function(e){
            $(\'.container-main>*\').removeClass(\'active\');
            $(\'.form_stage6\').addClass(\'active\');
            e.preventDefault();
        });
        $(".packages .table-row").on("click", function() {
            $(".selected").removeClass("selected");
            $(this).addClass("selected");
            $(".pack-desc").removeClass("active");
            switch (true) {
                case $(this).hasClass("intake-housing"):
                    $(".pack-desc.intake-housing").addClass("active");
                    break;
                case $(this).hasClass("housing-visa-basic"):
                    $(".pack-desc.housing-visa-basic").addClass("active");
                    break;
                case $(this).hasClass("housing-visa-extended"):
                    $(".pack-desc.housing-visa-extended").addClass("active");
                    break;
                case $(this).hasClass("all-in"):
                    $(".pack-desc.all-in").addClass("active");
                    break;
                case $(this).hasClass("all-in-ultra"):
                    $(".pack-desc.all-in-ultra").addClass("active");
                    break;
				case $(this).hasClass("standart"):
                    $(".pack-desc.standart").addClass("active");
                    break;
                default:

            };
            var width = window.innerWidth;
            if (width < 1024) {
                if ($(this).find(".services_SR").length){
                    $(".services_SR").slideUp(function() {
                        $(".services_SR").remove();
                    });
                }
                else {
                    $(".services_SR").remove();
                    $(this).append(\'<div class="table services services_SR" style="display: none;"><div class="table-row docs"><div class="icon"></div><div class="naming">Документы на визу</div><div class="price">549 €</div></div><div class="table-row selected intake"><div class="icon"></div><div class="naming">Поступление в университет</div><div class="price">1499 €</div></div><div class="table-row selected housing"><div class="icon"></div><div class="naming">Поиск жилья</div><div class="price">569 €</div></div><div class="table-row adaptation"><div class="icon"></div><div class="naming">Помощь в адаптации</div><div class="price">659 €</div></div><div class="table-row selected consulting"><div class="icon"></div><div class="naming">Online-консультации</div><div class="price">99 €</div></div><div class="table-row ultra"><div class="icon"></div><div class="naming">Перевод, заверение <br> и пересылка документов</div><div class="price">99 €</div></div></div>\');
                    $(".services_SR").slideDown();
                }
            };
            $(this).find(".active").each(function() {
                switch (true) {
                    case $(this).hasClass("docs"):
                        $(".tables").find(".services .docs").addClass("selected");
                        break;
                    case $(this).hasClass("intake"):
                        $(".tables").find(".services .intake").addClass("selected");
                        break;
                    case $(this).hasClass("housing"):
                        $(".tables").find(".services .housing").addClass("selected");
                        break;
                    case $(this).hasClass("adaptation"):
                        $(".tables").find(".services .adaptation").addClass("selected");
                        break;
                    case $(this).hasClass("consulting"):
                        $(".tables").find(".services .consulting").addClass("selected");
                        break;
                    case $(this).hasClass("ultra"):
                        $(".tables").find(".services .ultra").addClass("selected");
                        break;
                    default:
                };
            });
        });
        var mobileNav = $(\'.nav\');
        $(".nav-toggle").on("click", function(event){
            event.stopImmediatePropagation();

            var links = ($("nav .nav-wr.js-menu>ul>li>a"));
            if ($(this).hasClass(\'active\')) {
                $(this).removeClass(\'active\');
                $("a.arrow").remove();

                mobileNav.slideUp();
            } else {
                $(this).addClass(\'active\');
                mobileNav.slideDown();

                links.each(function() {
                    var link = $(this).attr("href");
                    $(this).append(\'<a class="arrow" href="\'+link+\'">></a>\');
                });
            }
            return false;
        });
        $(".nav-toggle").on("tap", function(event){
            event.stopImmediatePropagation();
            if ($(this).hasClass(\'active\')) {
                mobileNav.slideUp();
                $(this).removeClass(\'active\');
            } else {
                mobileNav.slideDown();
                $(this).addClass(\'active\');
            }
            return false;
        });
        $(\'.arrow\').click(function(event){
            event.stopImmediatePropagation();
            console.log("clicked");
        });
        $(".menu-trigger").on("click", function(e) {
            e.preventDefault();
            $(".search-form form").removeClass("active");
            $(".mobile-search").removeClass("open");
            $(".search-form").slideUp();
            $(".search-form hr").removeClass("active");


            $(this).addClass("bigmenu");
            var self = $(this);
            setTimeout(function() {
                self.removeClass("bigmenu");
            }, 100);
            $(this).toggleClass("open");
            $(".menu-mobile li").removeClass("open");
            $(".menu-mobile ul").removeClass("open");
            $(".menu-mobile hr").removeClass("active");
            $(".menu-mobile").slideToggle();
            $(".menu-mobile>li:first-child").toggleClass("active");

        });
        $(".menu-mobile>li>a:first-child").on("click", function(e) {
            e.preventDefault();
            $(this).closest("li").addClass("big");
            var self = $(this).closest("li");
            setTimeout(function() {
                self.removeClass("big");
            }, 200);
            if ($(this).closest("li").hasClass("open"))
            {
                var href = $(this).attr("href");
                window.location.replace(href);
                $(this).closest("li").removeClass("open");
                $(this).closest("li").children("ul").height(1);
                setTimeout(function () {
                    self.children("ul").removeClass("open");
                }, 300);
                $(this).closest("li").children("hr").removeClass("active");
                $(this).closest("li").children("ul").children("li:first-child").removeClass("active");
            }
            else {
                $(this).closest("li").addClass("open");
                $(this).closest("li").children("ul").addClass("open");
                $(this).closest("li").children("hr").addClass("active");
                var height = $(".menu-mobile").outerHeight();
                $(this).closest("li").children("ul").height(height);
                $(this).closest("li").children("ul").children("li:first-child").addClass("active");
            }
        });

        $(".mobile-search").on("click", function(e) {
            e.preventDefault();
            $(".menu-trigger").removeClass("open");
            $(".menu-mobile").slideUp();
            $(".menu-mobile>li:first-child").removeClass("active");
            $(".arrow").remove();
            $(this).addClass("bigsearch");
            $(".search-form form").toggleClass("active");
            var self = $(this);
            setTimeout(function() {
                self.removeClass("bigsearch");
            }, 100);
            if ($(this).hasClass("open"))
            {
                $(this).removeClass("open");
                $(".search-form").slideUp();
                $(".search-form hr").removeClass("active");
            }
            else
            {
                $(this).addClass("open");
                $(".search-form").slideDown();
                $(".search-form hr").addClass("active");
            }
        });

        setTimeout(
                function()
                {
                    console.log(

                            $(\'.fb-comments iframe\').contents().height()

                    );
                }, 5000);

        $("a.arrow").on("click", function(event) {
            event.stopImmediatePropagation();
        });


        $.getJSON("http://freegeoip.net/json/", function (data) {
            var country = data.country_name;
            var ip = data.ip;
            $(".tel a").removeClass("active");
            if (country == "Ukraine"){
                $(".ua-tel").addClass("active");
            } else if (country == "Russia"){
                $(".ru-tel").addClass("active");
            } else if (country == "Austria"){
                $(".au-tel").addClass("active");
            }else {
                $(".ru-tel").addClass("active");
            }
        });
        var is_ios = /(iPhone|iPod)/g.test( navigator.userAgent );
        if ($(window).width()<785 || is_ios){
            $(".important-info ul").slick({
                infinite: true,
                slidesToShow: 1,
            });
        }
        if(is_ios)
        {
            $(\'<link rel="stylesheet" type="text/css" href="assets/css/iOS.css" />\').appendTo("head");
        };
        if ( navigator.userAgent.match(/Android/i)
 || navigator.userAgent.match(/webOS/i)
 || navigator.userAgent.match(/iPhone/i)
 || navigator.userAgent.match(/iPad/i)
 || navigator.userAgent.match(/iPod/i)
 || navigator.userAgent.match(/BlackBerry/i)
 || navigator.userAgent.match(/Windows Phone/i)
 ) {

        }
		else {
jQuery(\'body\').on(\'click\', \'a[href^="tel:"]\', function() {
                jQuery(this).attr(\'href\',
                jQuery(this).attr(\'href\').replace(/^tel:/, \'callto:\'));
            });
		}

    });
</script>
<script>
  window.___gcfg = {
    lang: \'ru\'
  }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        if ($(window).width()<575){
            $(\'.reviews__video_index.report_small\').css(\'display\',\'block\');
            $(\'.reviews__video_index.report_large\').css(\'display\',\'none\');
        }
        $(\'.report_element .iframe\').css(\'min-height\',\'210px\');
        if ($(\'.lang\').attr(\'href\') == \'/ru/ua\'){
            $(\'.lang\').attr(\'href\', \'/ru\');
        }
        else{
            $(\'.lang\').attr(\'href\', \'/ua\');
        }

    $(\'.js-univer-counter\').countdown(\'2015/11/30\', function(event) {
        $(this).html(event.strftime(
                \'<span>%D</span>\'+
                \'<span>%H</span>\'+
                \'<span>%M</span>\'+
                \'<span>%S</span>\'
        ));
    });
    $(\'.js-reviews-cycle\').width(\'900\');
    });
</script>
<script>

$(document).ready(function(){

	$(\'#phone_form\').validate({
	  //debug: true,
	  rules:{
                phone_name: {
                    required: true,
                    minlength: 2
                },
                phone_text: {
                    required: true,
					minlength: 2
                },
                phone_phone: {
                    required: true,
                    minlength: 2
                }
            },
            messages: {
                phone_name: \'\',
                phone_text: \'\',
                phone_phone: \'\'
            },


	});

});
</script>
<!-- .row -->
<script  type="text/javascript">
$(document).ready(function(){
$(window).scroll(function(){
if ($(this).scrollTop() > 100) {
$(\'.scrollup\').fadeIn();
} else {
$(\'.scrollup\').fadeOut();
}
});

$(\'.scrollup\').click(function(){
$("html, body").animate({ scrollTop: 0 }, 600);
return false;
});
});
</script>
<script type="text/javascript">
$(document).ready(function(){
            $(\'.video_window\').easyModal();
var path = $(".video_frame iframe")[0].src;
            $(\'#video_window_open\').click(function(e){
                $(\'.video_window\').trigger(\'openModal\');
                $(".video_frame iframe")[0].src += "&autoplay=1";
                e.preventDefault();
            });
$(\'#video_window_open_mobile\').click(function(e){
                $(\'.video_window\').trigger(\'openModal\');
                $(".video_frame iframe")[0].src += "&autoplay=1";
                e.preventDefault();
            });
            $(\'#video_window_close\').click(function(e){
$(".video_frame iframe")[0].src = path;
                $(\'.video_window\').trigger(\'closeModal\');
                e.preventDefault();
            });
        });
</script>
<script type="text/javascript" src="assets/js/slick.min.js"></script>
<a class="scrollup">Наверх</a>
<script>
  (function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');

  ga(\'create\', \'UA-72128934-1\', \'auto\');
  ga(\'send\', \'pageview\');

</script>',
    'modChunk_locked' => '0',
    'modChunk_properties' => 'a:0:{}',
    'modChunk_static' => '0',
    'modChunk_static_file' => '',
    'Source_id' => '1',
    'Source_name' => 'Filesystem',
    'Source_description' => '',
    'Source_class_key' => 'sources.modFileMediaSource',
    'Source_properties' => 'a:0:{}',
    'Source_is_stream' => '1',
  ),
);