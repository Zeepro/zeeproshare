<div class="content-wrapper">
	<h2><?php echo t('enter_code') ?></h2>
	<div class="ui-grid-b ui-corner-all ui-shadow ui-transparent" style="padding: 5px;">
		<div id="error"></div>
		<div data-role="fieldcontain">
			<?php
				$this->load->helper('form');
				echo form_open('/user/confirm_signup',
								array('data-ajax' => 'false'));
			?>
			<input type="text" name="confirm_code" required="required" placeholder="<?php echo t('code') ?>">
			<br />
			<?php
				echo form_submit('submit', t('send_code'));
				echo form_close();
			?>
		</div>
	</div>
</div>
<script>
	$("form").on("submit", function()
	{
		$("#overlay").addClass("gray-overlay");
		$(".ui-loader").css("display", "block");
	});
</script>