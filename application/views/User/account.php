<div data-role="content">
	<div id="container" class="ui-grid-b ui-corner-all ui-shadow ui-transparent" style="padding: 5px; color: #000; text-shadow: 0 1px #FFF;">
		<a href="/user/info" data-role="button" data-theme="b" data-ajax="false" class="ui-link ui-btn ui-btn-b ui-shadow ui-corner-all">{link_user_info}</a>
		<div data-role="collapsible-set">
			<div data-role="collapsible" id="account_menu_optin">
				<h3>{title_account_optin}</h3>
				<p>{hint_account_optin}</p>
				<div class="ui-field-contain">
					<label for="account_optin_update">{title_optin_update}</label>
					<select name="account_optin_update" id="account_optin_update" data-role="slider" data-track-theme="b" data-theme="b">
						<option value="off" >{function_off}</option>
						<option value="on" {optin_update_on}>{function_on}</option>
					</select>
				</div>
				<div class="ui-field-contain">
					<label for="account_optin_news">{title_optin_news}</label>
					<select name="account_optin_news" id="account_optin_news" data-role="slider" data-track-theme="b" data-theme="b">
						<option value="off" >{function_off}</option>
						<option value="on" {optin_news_on}>{function_on}</option>
					</select>
				</div>
			</div>
			<div data-role="collapsible" id="account_menu_change_pwd">
				<h3>{title_change_pwd}</h3>
				<form method="POST" accept-charset="utf-8" id="account_form_change_pwd">
					<input type="password" name="old_pass" required="required" placeholder="{title_old_password}">
					<input type="password" name="new_pass" required="required" placeholder="{title_new_password}">
					<input type="password" name="confirm_pass" required="required" placeholder="{title_confirm_pwd}">
					<input type="checkbox" name="show_pass" id="show_pass" data-mini="true" />
					<label for="show_pass" style="background-color: transparent; border-width: 0;">{option_show_pwd}</label>
					<input type="submit" name="change" value="{button_pwd_change}" data-theme="b" />
				</form>
			</div>
			<div data-role="collapsible" id="account_menu_delete">
				<h3>{title_account_delete}</h3>
				<form method="POST" accept-charset="utf-8" id="account_form_delete">
					<input type="password" name="old_pwd" placeholder="{hint_account_delete}" required />
					<input type="checkbox" name="show_pass" id="show_pass" data-mini="true" />
					<label for="show_pass" style="background-color: transparent; border-width: 0;">{option_show_pwd}</label>
					<input type="submit" name="delete" value="{button_account_delete}" data-theme="b" />
				</form>
			</div>
		</div>
		<div class="zim-error">{error}</div>
	</div>
</div>

<script>
$("select#account_optin_news").change(function() {
	var var_state = $("select#account_optin_news").val().toString();
	var_ajax = $.ajax({
		url: "/user/set_optin_ajax",
		cache: false,
		data: {
			p: "news",
			v: var_state,
			},
		type: "GET",
	})
	.fail(function() {
 		alert("failed");
 	});
});

$("input[name=show_pass]").click(function() {
	var var_formId = $(this.form).attr("id"); // $(this).closest("form")
	
	if ($(this).is(':checked')) {
		$("form#" + var_formId +" input[type=password]").attr("type", "text");
	}
	else {
		$("form#" + var_formId +" input[type=text]").attr("type", "password");
	}
});

// add header?
$("header.page-header").html('<a href="javascript:history.back();" data-icon="back" data-theme="b">{back}</a> <a href="/user/v2" data-icon="home" data-theme="b">{home}</a>');
</script>