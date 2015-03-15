<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="cache-control" content="no-cache" />
		<meta http-equiv="expires" content="0" />
		<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
		<meta http-equiv="pragma" content="no-cache" />
		<title>Home - Zim</title>
        <link rel="stylesheet" href="/assets/jquery.mobile-1.4.2/jquery.mobile-1.4.2.css" />
        <link rel="stylesheet" href="/assets/css/home.css" />
		
        <script src="/assets/jquery-2.1.1.min.js"></script>
        <script src="/assets/jquery.mobile-1.4.2/jquery.mobile-1.4.2.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, target-densitydpi=medium-dpi, user-scalable=0" />
        <script>
            $(document).bind("mobileinit", function() {
                $.mobile.defaultPageTransition = 'slide';
            });
        </script>
        <style type="text/css">
            div.logo {
            	margin-top:-9px;
            	width:100%;
                height:80px;
                background:url("/assets/img/logoback.jpg") center no-repeat;
            }
            div#link_logo
			{
                margin: 0 auto;
                width: 270px;
                height: 55px;
                cursor: pointer;
            }
            .ui-body-c{
                color:#ffffff;
                background:url("/assets/img/home.jpg") 50% 100px;
            }
            .page-header {
                background:url("/assets/img/headerBack.jpg") bottom center;
                border:0px;
                color:#333;
                height:38px;
            }
			.gray-overlay
			{
				background-color: rgba(250, 250, 250, 0);
				z-index: 999;
				position: fixed;
				left: 0;
				top: 0;
				width: 100%;
				min-height: 100%;
				display: block;
			}
			.zim-error
			{
				color: red;
				text-shadow: 0 1px 0 #fff !important;
				font-weight: bold;
			}
			.ui-loader-default
			{
				opacity:0.5;
			}
			h2
			{
				text-align: center;
			}
			.ui-transparent
			{
                background:url("/assets/img/tr150.png") repeat;
			}
        </style>
        <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', "UA-60678926-1"]);
        _gaq.push(['_setDomainName', 'none']);
        (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
        function fireTracker() {
        hash = location.hash;
        if (hash) {
        _gaq.push(['_trackPageview', hash.substr(1)])
        } else {
        _gaq.push(['_trackPageview', location.pathname])
        }
        }
        $($(document).on('pageshow', fireTracker));
        $(document).on("pageinit", function()
            {
    		    $('div#link_logo').click(function()
                {
                    window.location.href='/';
                    return false;
                });
    	    });
        </script>
    </head>
    <body>
		<div id="overlay"></div>
        <div data-role="page" class="ui-body-c">
            <header data-role="header" class="page-header">
            </header>
            <div class="logo"><div id="link_logo"></div></div>
            {body_content}
        </div>
    </body>
</html>