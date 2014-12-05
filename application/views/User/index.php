<div class="content-wrapper">
	<center>
	<br />
	<?php
		$this->load->helper('form');
		if ($printers != NULL)
		{
			$i = 0;
			echo "<center><b>{connected}</b></center>";
			echo '<br /><ul data-role="listview" data-inset="true">';
			foreach ($printers as $printer)
			{
				echo "<li>";
				echo "<form action='http://" . $printer->URL . "/set_cookie' method='POST' id='printer" . $i ."'>";
				echo form_hidden('token', $printer->token);
				echo form_close();
				echo '<a class="printer_link" data-localip="' . $printer->localIP . '"data-nb="' . $i . '">' . $printer->printername . '</a></li>';
				$i++;
			}
		}
		else
		{
			echo "<div style='text-align:center'><b>". t('no_printer') ."</b></div><br />";
		}
	?>
	</ul>
	<br />
	<br />
	<ul data-role="listview" id="listview" class="shadowBox" data-inset="true">
        <li>
			<a href="/user/change_password"><h2>{change_pass}</h2></a>
		</li>
	</ul>
	<a style="margin-top: 30px;" href="/login/disconnect" data-role="button" data-ajax="false">{signout}</a>
	</center>
	<script>
		$("a.printer_link").on("click", function()
		{
			var img = new Image();
			var nb = $(this).data('nb');
			var	localip = $(this).data('localip');

			$("#overlay").addClass('gray-overlay');
			$(".ui-loader").css("display", "block");
			img.src = "http://" + localip + '/assets/images/logo-1.png?_=' + Date.now();
			var selector = "#printer" + nb;
			setTimeout(function(selector, localip)
			{
				if (img.height > 0)
					$(selector).attr('action', 'http://' + localip + '/set_cookie');
				$(selector).submit();
			}, 4000, selector, localip);
		});
	</script>
</div>