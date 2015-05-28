<style type="text/css">
	p
	{
	color: #000;
	text-shadow: 0 1px #FFF;
	}
	h2
	{
	color: #000;
	text-shadow: 0 1px #FFF;
	}
	.ui-icon-fb-icon:after
	{
		background-image: url("/assets/img/icon/fb_icon.png");
	}
	.ui-icon-yt-icon:after
	{
		background-image: url("/assets/img/icon/yt_icon.png");
	}
	.ui-icon-pt-icon:after
	{
		background-image: url("/assets/img/icon/pt_icon.png");
	}
	.ui-icon-tw-icon:after
	{
		background-image: url("/assets/img/icon/tw_icon.png");
	}
	.ui-icon-gp-icon:after
	{
		background-image: url("/assets/img/icon/gp_icon.png");
	}
	.ui-icon-fc-icon:after
	{
		background-image: url("/assets/img/icon/fc_icon.png");
	}
	.ui-icon-ig-icon:after
	{
		background-image: url("/assets/img/icon/ig_icon.png");
	}
	.ui-icon-li-icon:after
	{
		background-image: url("/assets/img/icon/li_icon.png");
	}
</style>
<!-- <div id="confirm_v2" data-role="popup" data-position-to="window" class="ui-content"> -->
<!-- 	<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right"></a> -->
<!-- 	<div data-role="content"> -->
<!-- 	    <p>{areyousure}</p> -->
<!-- 	    <a href="javascript:disconnect()" data-role="button" data-theme="b" data-ajax="false">{yes}</a> -->
<!-- 	    <a href="#" data-role="button" data-theme="c" data-rel="back">{no}</a> -->
<!-- 	</div> -->
<!-- </div> -->

<div class="content-wrapper">
	<div class="ui-grid-b ui-corner-all ui-shadow ui-transparent" style="padding: 5px;">
		<h2>{follow_us}</h2>
		<div class="ui-grid-b ui-responsive">
			<div class="ui-block-a"><a href="https://www.facebook.com/Zeepro3dprinter" target="_blank" data-ajax="false" data-role="button" class="ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-icon-fb-icon">{facebook}</a></div>
			<div class="ui-block-b"><a href="https://twitter.com/zeeproshare" target="_blank" data-ajax="false" data-role="button" class="ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-icon-tw-icon">{twitter}</a></div>
			<div class="ui-block-c"><a href="https://instagram.com/zeeproshare" target="_blank" data-ajax="false" data-role="button" class="ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-icon-ig-icon">{instagram}</a></div>
<!-- 		    <div class="ui-block-c" style="margin-top:-20px"><a href="http://pinterest.com/pin/create/button/?url=http://zeepro.com&media=//cdn.shopify.com/s/files/1/0615/4465/t/89/assets/logo.png?14950146646124718182&description=Zeepro" target="_blank" data-ajax="false" data-role="button" class="ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-icon-pt-icon">{pinterest}</a></div> -->
		</div>
		<div class="ui-grid-b ui-responsive">
<!-- 			<div class="ui-block-a"><a href="https://plus.google.com/+Zeepro/videos" target="_blank" data-ajax="false" data-role="button" class="ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-icon-gp-icon">{googleplus}</a></div> -->
<!-- 			<div class="ui-block-b"><a href="http://www.thefancy.com/fancyit?ItemURL=http://zeepro.com&Title=Zeepro" target="_blank" data-ajax="false" data-role="button" class="ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-icon-fc-icon">{fancy}</a></div> -->
			<div class="ui-block-a"><a href="https://www.youtube.com/channel/UCes39gehIaKnTUGHPvywctA" target="_blank" data-ajax="false" data-role="button" class="ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-icon-yt-icon">{youtube}</a></div>
			<div class="ui-block-b"><a href="https://www.linkedin.com/company/zeepro" target="_blank" data-ajax="false" data-role="button" class="ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-icon-li-icon">{linkedin}</a></div>
		</div>
	</div>
	<script>
// 		$("header.page-header").html('<a href="#confirm_v2" data-rel="popup" data-transition="pop" data-icon="power" data-iconpos="notext" class="ui-btn-right"></a>')
		$("header.page-header").html('<a href="javascript:history.back();" data-icon="back" data-theme="b">{back}</a> <a href="/user/v2" data-icon="home" data-theme="b">{home}</a>');
// 		function disconnect() {
// 			$("#overlay").addClass('gray-overlay');
// 			$(".ui-loader").css("display", "block");
// 			window.location = "/login/disconnect";
// 		};
		</script>
</div>