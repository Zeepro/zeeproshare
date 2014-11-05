<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
		<title>Home - Zim</title>
        <link rel="stylesheet" href="/assets/jquery.mobile-1.4.2/jquery.mobile-1.4.2.min.css" />
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
                width:100%;
                height:110px;
                background:url("/assets/img/logo-white.png") top center no-repeat;
                background-size: 212px 59px;
            }
            div#link_logo
			{
                margin: 0 auto;
                width: 97px;
                height: 100px;
                cursor: pointer;
            }
            .ui-body-c{
                color:#575749;
                background:url("/assets/img/back-4.jpg") 0 -100px repeat-x  #f9f7f3;
                background-size: 79px 245px;
            }
            .page-header {
                background:url("/assets/img/headerBack.png") bottom repeat-x;
                border:0px;
                color:#333;
                height:38px;
                text-shadow: 0 -1px 1px #fff;
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
				font-weight: bold;
			}
        </style>
        <script type="text/javascript">
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