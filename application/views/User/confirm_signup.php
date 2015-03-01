<div class="content-wrapper">
	<h2><?php echo t('enter_code') ?></h2>
	<div class="ui-grid-b ui-corner-all ui-shadow ui-transparent" style="padding: 5px;">
		<div id="error"></div>
		<div data-role="fieldcontain">
			<form action="/user/confirm_signup" method="post" accept-charset="utf-8" data-ajax="false">
				<input type="text" name="confirm_code" required="required" placeholder="<?php echo t('code') ?>">
				<br />
				<input type="submit" name="submit" value="<?php echo t('send_code') ?>" data-theme="b" />
			</form>
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