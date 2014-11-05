<div class="content-wrapper">
	<center>
		<h1>Confirmation</h1>
	</center>
	<div id="error"></div>
	<div data-role="fieldcontain">
		<?php
			$this->load->helper('form');
			echo form_open('/user/confirm_signup',
							array('data-ajax' => 'false'));
			echo form_label(t('enter_code'), 'confirm_code');
			echo form_input(array('name' => 'confirm_code', 'required' => 'required'));
			echo '<br />';
			echo form_submit('submit', t('send_code'));
			echo form_close();
		?>
	</div>
</div>
<script>
	$("form").on("submit", function()
	{
		$("#overlay").addClass("gray-overlay");
		$(".ui-loader").css("display", "block");
	});
</script>