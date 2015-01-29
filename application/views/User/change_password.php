<div class="content-wrapper">
	<div class="ui-grid-b ui-corner-all ui-shadow ui-transparent" style="padding: 5px;">
		<div id="error"></div>
		<div data-role="fieldcontain">
			<?php
				$this->load->helper('form');
				echo form_open('/index.php/user/change_password', array('data-ajax' => 'false'));
			?>
			<input type="password" name="old_pass" required="required" placeholder="<?php echo t('old')?>">
			<input type="password" name="new_pass" required="required" placeholder="<?php echo t('new')?>">
			<input type="password" name="confirm_pass" required="required" placeholder="<?php echo t('confirm')?>">
			<input type="checkbox" name="show_pass" id="show_pass" data-mini=true>
			<label for="show_pass" style="background-color: transparent;border-width:0">{show_password}</label>
			<?php
				echo form_submit("submit", t('submit_change'));
				echo form_close();
			?>
		</div>
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
			$("input[type=text]").attr("type", "password");
	});
</script>