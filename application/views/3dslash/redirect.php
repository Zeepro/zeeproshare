<div class="content-wrapper">
	<h2>{connected}</h2>
	<div class="ui-grid-b ui-corner-all ui-shadow ui-transparent" style="padding: 5px;">
		<?php
			$this->load->helper('form');
			$i = 0;
			echo '<br /><ul data-role="listview" data-inset="true">';
			foreach ($printers as $printer)
			{?>
				<li>
				<form method="POST" id="printer<?php echo $i ?>">
					<input type="hidden" name="name" value="<?php echo $this->session->userdata('3dslash_name') ?>">
					<input type="hidden" name="token" value="<?php echo $this->session->userdata('3dslash_token') ?>">
				</form>
				<a class="printer_link" data-localip="<?php echo $printer->localIP ?>" data-url="<?php echo $printer->URL ?>" data-token="<?php echo $printer->token ?>" data-nb="<?php echo $i ?>"><?php echo $printer->printername ?></a>
				</li>
				<?php $i++;
			}
		?>
	</div>

	<script>
		$("a.printer_link").on("click", function()
		{
			var img = new Image();
			var nb = $(this).data('nb');
			var selector = "#printer" + nb;
			var	localip = $(this).data('localip');
			var	url = $(this).data('url');
			var	token = $(this).data('token');
									
			$("#overlay").addClass('gray-overlay');
			$(".ui-loader").css("display", "block");
			img.src = "http://" + localip + '/images/pixel.png?_=' + Date.now();
			setTimeout(function(selector, localip, url) {
				if (img.height > 0) {
					$(selector).attr("action", "http://" + localip + "/3dslash");
					$(selector).submit();
				} else {
					$.ajax({
						url: "https://" + url + "/set_cookie",
						cache: false,
						method: 'post',
						async: true,
						xhrFields: {
							withCredentials: true,
						},
						data: {token: token},
						success: function() {
							console.log('remote set cookie success');
							$(selector).attr("action", "https://" + url + "/3dslash");
							$(selector).submit();
						},
						error: function() {
							console.log('remote set cookie failed');
							location.reload();
						}
					});
				}
			}, 4000, selector, localip, url, token);
		});
	</script>
</div>