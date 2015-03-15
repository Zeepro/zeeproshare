<div class="content-wrapper">
	<h2>{zeepro_account}</h2>
	<div class="ui-grid-b ui-corner-all ui-shadow ui-transparent" style="padding: 5px; padding-bottom: 25px; color: #000;  text-shadow: 0 1px 0 #fff">
		<div id="error"><?php $this->load->helper('form'); echo validation_errors('<p class="zim-error">', '</p>'); ?>{custom_error}</div>
		<div data-role="fieldcontain">
			<?php
			if (isset ( $_COOKIE ['remember_me_home_zeepro'] )) {
				$cred = explode ( ':', $_COOKIE ['remember_me_home_zeepro'] );
				$checked = "checked";
			} else {
				$cred = array (
						"",
						""
				);
				$checked = "";
			}?>
			<form action="/login/index" method="post" accept-charset="utf-8" data-ajax="false">
				<input type="text" name="email" value="<?php echo $cred[0]?>" required="required" placeholder="{email}">
				<input type="password" name="password" value="<?php echo $cred[1]?>" required="required" placeholder="{password}">
			    <fieldset data-role="controlgroup">
			        <input type="checkbox" name="show_pass" id="show_pass" data-mini="true">
			        <label for="show_pass" style="background-color: transparent;border-width:0">{show_password}</label>
			        <input type="checkbox" name="remember" id="remember" data-mini="true" <?php echo $checked?>>
			        <label for="remember" style="background-color: transparent;border-width:0">{remember_box}</label>
			        <input type="checkbox" name="optin" id="optin" data-mini="true" <?php echo "{optin}"?>>
			        <label for="optin" style="background-color: transparent;border-width:0">{newsletter_box}</label>
		    	</fieldset>
				<input type="submit" name="submit" value="<?php echo t('signin')?>" data-theme="b"/>
			</form>
		</div>
		<a href="/user/signup" data-role="button" data-theme="b" data-ajax="false">{signup}</a>
		<br />
		<a href="/login/forgot_pass" data-ajax="false" style="font-weight: normal;color: #000; text-shadow: 0 1px 0 #fff">{forgot_pass}</a>
		<br />
		<br />
		<a href="/login/privacy" data-ajax="false" style="font-weight: normal;color: #000; text-shadow: 0 1px 0 #fff">{privacy_policy_link}</a>
	</div>
</div>

<script type="text/javascript">
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