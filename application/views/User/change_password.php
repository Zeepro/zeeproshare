<div class="content-wrapper">
    <center>
		<h1>{submit_change}</h1>
	</center>
	<div id="error"></div>
	<div data-role="fieldcontain">
		<?php
			$this->load->helper('form');
			echo form_open('/index.php/user/change_password', array('data-ajax' => 'false'));
			echo form_label(t('old'), "old_pass");
			echo form_password(array("name" => "old_pass", 'required' => 'required'));
			echo form_label(t('new'), "new_pass");
			echo form_password(array("name" => "new_pass", 'required' => 'required'));
			echo form_label(t('confirm'), "confirm_pass");
			echo form_password(array("name" => "confirm_pass", 'required' => 'required'));
			echo "<div>";
			echo '<label><input type="checkbox" name="show_pass" data-mini=true> {show_password} </label>';
			echo "</div><br />";
			echo form_submit("submit", t('submit_change'));
			echo form_close();
		?>
	</div>
	<a href="/index.php/user/" data-role="button">{back}</a>
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
			$("input[type=text]").attr("type", "password");
	});
</script>