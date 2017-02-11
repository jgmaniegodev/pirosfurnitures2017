;
(function($) {
    $(document).ready(function() {
        var $mainContent = $("#service-details"),
            //        siteUrl = 
            siteUrl = "http://" + top.location.host.toString(),
            url = '';
        $mainContent.animate({ opacity: "0.1" }).html('<div style="text-align: center; font-size: 3em"><i class="fa fa-cog fa-spin" style="vertical-align: middle"></i></div>').load('piros_services/office-developments/', function() {
            $mainContent.animate({ opacity: "1" });
        });
        $(document).delegate(".service a[href^='" + siteUrl + "']:not([href*='/wp-admin/']):not([href*='/wp-login.php']):not([href$='/feed/'])", "click", function() {
            location.hash = this.pathname;
            return false;
        });
        //    $mainContent.animate({opacity: "0.1"}).html('<div style="text-align: center; font-size: 3em"><i class="fa fa-cog fa-spin" style="vertical-align: middle"></i></div>').load('#/piros_services/office-developments/', function() {
        //            $mainContent.animate({opacity: "1"});
        //        });
        //    $("#searchform").submit(function(e) {
        //        location.hash = '?s=' + $("#s").val();
        //        e.preventDefault();
        //    }); 

        $(window).bind('hashchange', function() {
            //        url = window.location.hash.substring(1); 
            url = window.location.hash.substring(1);
            if (!url) {
                return;
            }
            url = url + " #service-detail";

            $mainContent.animate({ opacity: "0.1" }).html('<div style="text-align: center; font-size: 3em"><i class="fa fa-cog fa-spin" style="vertical-align: middle"></i></div>').load(url, function() {
                $mainContent.animate({ opacity: "1" });
            });
        });
        $(window).trigger('hashchange');
        
        $("#menu-bar").on("click", function(){
           $(this).toggleClass("active");
           $(".primary-nav").slideToggle("fast"); 
        });
    });
    
})(jQuery);