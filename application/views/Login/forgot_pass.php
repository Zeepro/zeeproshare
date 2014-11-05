<div class='content-wrapper'>
	<h2>{zeepro_account}<h2>
	<div id="error"><?php $this->load->helper('form'); echo validation_errors('<p class="zim-error">', '</p>'); ?></div>
	<div data-role="fieldcontain">
		<?php
			echo form_open('/index.php/login/forgot_pass', array('data-ajax' => "false"));
			echo form_label('Email', 'email');
			echo form_input(array('name' => 'email', 'required' => 'required'));
		?>
			<input type="submit" name="submit" value="{reset_pass}" />
			</form>
	</div>
<script>
	$("form").on("submit", function()
	{
		$("#overlay").addClass("gray-overlay");
		$(".ui-loader").css("display", "block");
	});
</script>
</div>