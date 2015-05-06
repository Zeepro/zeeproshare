<style type="text/css">
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
		<h2>{news}</h2>
		<h2>{inspiration}</h2>
		<h2>{myzeeproshare}</h2>
		<?php
			$this->load->helper('form');
			if ($printers != NULL)
			{
				$i = 0;
				echo '<br /><ul data-role="listview" data-inset="true">';
				foreach ($printers as $printer)
				{
					echo "<li>";
					echo "<form action='https://" . $printer->URL . "/set_cookie' method='POST' id='printer" . $i ."'>";
					echo form_hidden('token', $printer->token);
					echo form_hidden('user', $user_token);
					echo form_close();
					echo '<a class="printer_link" data-localip="' . $printer->localIP . '"data-nb="' . $i . '">' . $printer->printername . '</a></li>';
					$i++;
				}
				echo "</ul>";
			}
		?>
		<h2>{channels}</h2>
		<a style="margin-top: 20px;" href="/user/share" data-role="button" data-theme="b" data-ajax="false">{share}</a>
		<a href="/user/follow" data-role="button" data-theme="b" data-ajax="false">{follow}</a>
		<a href="http://zeepro.com/collections/all" target="_blank" data-role="button" data-theme="b" data-ajax="false">{store}</a>
		<a href="/user/support" data-role="button" data-theme="b" data-ajax="false">{support}</a>
	</div>

	<script>
		$("header.page-header").html('<a href="#confirm_v2" data-rel="popup" data-transition="pop" data-icon="power" data-iconpos="notext" class="ui-btn-right"></a>')
		$("a.printer_link").on("click", function()
		{
			var img = new Image();
			var nb = $(this).data('nb');
			var	localip = $(this).data('localip');

			$("#overlay").addClass('gray-overlay');
			$(".ui-loader").css("display", "block");
			img.src = "http://" + localip + '/images/pixel.png?_=' + Date.now();
			var selector = "#printer" + nb;
			setTimeout(function(selector, localip)
			{
				if (img.height > 0) {
					$.ajax({
						url: "http://" + localip + "/set_cookie/user",
						cache: false,
						async: true,
						xhrFields: {
							withCredentials: true,
						},
						success: function() {
							console.log('CORS and verification ok, pass directly without token');
							window.location.href = 'http://' + localip;
						},
						error: function() {
							console.log('CORS or verification failed, use POST URL (not be secured in local network)');
							$(selector).attr('action', 'http://' + localip + '/set_cookie/user');
							$(selector + ' input[name=token]').prop('disabled', true);
							$(selector).submit();
						}
					});
// 					window.location.href = 'http://' + localip;
				} else {
					$(selector).submit();
				}
			}, 4000, selector, localip);
		});
		function disconnect() {
			$("#overlay").addClass('gray-overlay');
			$(".ui-loader").css("display", "block");
			window.location = "/login/disconnect";
		};
	</script>
</div>