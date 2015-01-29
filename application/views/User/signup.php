<div class="content-wrapper">
	<h2>{signup}</h2>
	<div class="ui-grid-b ui-corner-all ui-shadow ui-transparent" style="padding: 5px; padding-bottom: 25px;">
		<div id="error"><?php $this->load->helper('form'); echo validation_errors('<p class="zim-error">', '</p>');?></div>
		<div data-role="fieldcontain">
			<?php
				echo form_open('/user/signup', array('data-ajax' => 'false'));
			?>
			<input type="text" name="email" required="required" placeholder="{email}">
			<input type="password" name="password" required="required" placeholder="{password}">
			<input type="password" name="confirm" required="required" placeholder="{confirmpassword}">
			<input type="checkbox" name="show_pass" id="show_pass" data-mini=true>
			<label for="show_pass" style="background-color: transparent;border-width:0">{show_password}</label>
			<?php
				echo form_submit('submit', t('signup_btn'));
				echo form_close();
			?>
		</div>
		<div>
			<p style="font-weight: normal;color: #000; text-shadow: 0 1px 0 #fff">{signup_text}</p>
		</div>
		<a href="/login/privacy" data-ajax="false" style="font-weight: normal;color: #000; text-shadow: 0 1px 0 #fff">{privacy_policy_link}</a>
	</div>
</div>

<script>
	$("header.page-header").html('<a href="javascript:history.back();" data-role="button" data-icon="back" data-ajax="false">{back}</a>')
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