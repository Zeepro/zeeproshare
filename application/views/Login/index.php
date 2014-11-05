<div class="content-wrapper">
	<h2>{zeepro_account}</h2>
	<div id="error"><?php $this->load->helper('form'); echo validation_errors('<p class="zim-error">', '</p>'); ?>{custom_error}</div>
	<div data-role="fieldcontain">
		<?php
			if (isset($_COOKIE['remember_me_home_zeepro']))
			{
				$cred = explode(':', $_COOKIE['remember_me_home_zeepro']);
				$checked = 'checked';
			}
			else
			{
				$cred = array("", "");
				$checked = "";
			}
			echo form_open('/login/index', array('data-ajax' => "false"));
			echo form_label('Email', 'email');
			echo "<div>";
			echo form_input(array('name' => 'email', 'value' => $cred[0], 'required' => 'required'));
			echo "</div>";
			echo "<div>";
			echo form_label(t("password"), 'password');
			echo form_password(array('name' => 'password', 'value' => $cred[1], 'required' => 'required'));
			echo "</div>";
			echo "<div>";
			echo '<label><input type="checkbox" name="show_pass" data-mini=true> {show_password} </label>';
			echo "</div><br />";
			echo "<div>";
			echo '<label><input type="checkbox" name="remember" data-mini=true ' . $checked . '> {remember_box} </label>';
			echo "</div><br />";
			echo form_submit('submit', t('signin'));
			echo form_close();
		?>
	</div>
    <a href="/login/forgot_pass" data-role="button" data-ajax="false">{forgot_pass}</a>
	<h2>{create}</h2>
	<a href="/user/signup" data-role="button" data-ajax="false">{signup}</a>
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
			$("input[name=password]").attr("type", "text");
		else
			$("input[name=password]").attr("type", "password");
	});
</script>