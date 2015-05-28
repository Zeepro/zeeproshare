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
</style>
<div class="content-wrapper">
	<div class="ui-grid-b ui-corner-all ui-shadow ui-transparent" style="padding: 5px;">
		<ul data-role="listview" class="shadowBox" data-inset="true">
			<li><a href="/user/support" target="_blank"><h2>{link_tutorial}</h2></a></li>
			<li><a href="http://zimsupport.zeepro.com/support/home" target="_blank"><h2>{link_faq}</h2></a></li>
			<li><a href="http://zimsupport.zeepro.com/support/tickets/new" target="_blank"><h2>{link_support}</h2></a></li>
		</ul>
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