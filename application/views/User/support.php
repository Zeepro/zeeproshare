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
<div id="confirm_v2" data-role="popup" data-position-to="window" class="ui-content">
	<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right"></a>
	<div data-role="content">
	    <p>{areyousure}</p>
	    <a href="javascript:disconnect()" data-role="button" data-theme="b" data-ajax="false">{yes}</a>
	    <a href="#" data-role="button" data-theme="c" data-rel="back">{no}</a>
	</div>
</div>

<div class="content-wrapper">
	<div class="ui-grid-b ui-corner-all ui-shadow ui-transparent" style="padding: 5px;">
		...
	</div>
	<script>
		$("header.page-header").html('<a href="#confirm_v2" data-rel="popup" data-transition="pop" data-icon="power" data-iconpos="notext" class="ui-btn-right"></a>')
		function disconnect() {
			$("#overlay").addClass('gray-overlay');
			$(".ui-loader").css("display", "block");
			window.location = "/login/disconnect";
		};
		</script>
</div>