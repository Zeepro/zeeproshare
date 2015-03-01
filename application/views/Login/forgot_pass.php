<div class='content-wrapper'>
	<div class="ui-grid-b ui-corner-all ui-shadow ui-transparent" style="padding: 5px;">
		<div id="error"><?php $this->load->helper('form'); echo validation_errors('<p class="zim-error">', '</p>'); ?></div>
		<div data-role="fieldcontain">
			<form action="/login/forgot_pass" method="post" accept-charset="utf-8" data-ajax="false">
				<input type="text" name="email" required="required" placeholder="<?php echo t('email')?>">
				<input type="submit" name="submit" value="<?php echo t('reset_pass') ?>" data-theme="b" />
			</form>
		</div>
	</div>
<script>
	$("header.page-header").html('<a href="javascript:history.back();" data-role="button" data-theme="b" data-icon="back" data-ajax="false"><?php echo t('back')?></a>')
	$("form").on("submit", function()
	{
		$("#overlay").addClass("gray-overlay");
		$(".ui-loader").css("display", "block");
	});
</script>
</div>