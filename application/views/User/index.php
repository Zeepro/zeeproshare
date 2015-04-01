<div class="content-wrapper">
	<h2>{connected}</h2>
	<div class="ui-grid-b ui-corner-all ui-shadow ui-transparent" style="padding: 5px;">
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
		<a style="margin-top: 30px;" href="/user/change_password" data-role="button" data-theme="b" data-ajax="false">{change_pass}</a>
		<a style="margin-top: 30px;" href="/login/disconnect" data-role="button" data-theme="b" data-ajax="false">{signout}</a>
	</div>

	<script>
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
	</script>
</div>