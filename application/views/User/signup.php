<div class="content-wrapper">
	<center>
		<h1>{signup}</h1>
	</center>
	<div id="error"><?php $this->load->helper('form'); echo validation_errors('<p class="zim-error">', '</p>');?></div>
	<div data-role="fieldcontain">
		<?php
			echo form_open('/user/signup', array('data-ajax' => 'false'));
			echo form_label('Email', 'email');
			echo form_input(array('name' => 'email', 'required' => 'required'));
			echo form_label(t('Password'), 'password');
			echo form_password(array('name' => 'password', 'required' => 'required'));
			echo form_label(t('confirm'), 'confirm');
			echo form_password(array('name' => 'confirm', 'required' => 'required'));
			echo '<br /><div>';
			echo '<label><input type="checkbox" name="show_pass" data-mini=true> {show_password} </label>';
			echo "</div><br />";
			echo form_submit('submit', t('signup'));
			echo form_close();
		?>
	</div>
	<div>
		<p>{signup_text}</p>
	</div>
	<a href="/login/" data-role="button">{back}</a>
</div>

<script>
	$("form").on("submit", function()
	{
		$("#overlay").addClass("gray-overlay");
		$(".ui-loader").css("display", "block");
	});
	$("input[name=show_pass]").on("click", function()
	{
		if ($("input[name=show_pass]").is(':checked'))
			$("input[type=password]").attr("type", "text");
		else
		{
			$("input[name=password]").attr("type", "password");
			$("input[name=confirm]").attr("type", "password");
		}
	});
</script>