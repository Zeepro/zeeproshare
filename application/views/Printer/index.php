<div class="content-wrapper">
	<br />
	<?php
		$this->load->helper('form');
		if ($printers != NULL)
		{
			$i = 0;
			echo "<center>{connected}</center>";
			echo '<br /><ul data-role="listview" data-inset="true">';
			foreach ($printers as $printer)
			{
				echo "<li>";
				echo "<form action='https://" . $printer->URL . "/set_cookie' method='POST' id='printer" . $i ."'>";
				echo form_hidden('token', $printer->token);
				echo form_close();
				
				echo '<a class="printer_link" data-localip="' . $printer->localIP . '"data-nb="' . $i . '">' . $printer->printername . '</a></li>';
				$i++;
			}
			echo "</ul>";
		}
		else
		{
			echo "<div style='text-align:center'>". t('no_printer') ."</div>";
		}
	?>
	<a href="/index.php/user/" data-role="button">{back}</a>
</div>

<script>
$("a.printer_link").on("click", function()
{
	var img = new Image();
	var nb = $(this).data('nb');
	var localip = $(this).data('localip');
	
	$("#overlay").addClass('gray-overlay');
	$(".ui-loader").css("display", "block");
	img.src = "http://" + localip + '/assets/images/logo-1.png?_=' + Date.now();
	var selector = "#printer" + nb;
	setTimeout(function(selector, localip)
	{
		if (img.height > 0)
		{
			$(selector).attr('action', 'https://' + localip + '/set_cookie');
		}
		$(selector).submit();
	}, 4000, selector, localip);
});
</script>