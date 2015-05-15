<div data-role="content">
	<div id="container" class="ui-grid-b ui-corner-all ui-shadow ui-transparent" style="padding: 5px; color: #000; text-shadow: 0 1px #FFF;">
<!-- 		<a href="/user/info" data-role="button" data-theme="b" data-ajax="false" class="ui-link ui-btn ui-btn-b ui-shadow ui-corner-all">{link_user_info}</a> -->
		<div data-role="collapsible-set">
			<div data-role="collapsible" id="account_menu_profile">
				<h3>{link_user_info}</h3>
				<form method="POST" data-ajax="false">
					<p>{msg_head_hint}</p>
					<label for="user_country">{title_location}</label>
					<select name="user_country" id="user_country" data-oldvalue="{value_country}">
						<option value="">{hint_country}</option>
					</select>
					<select name="user_city" id="user_city" data-oldvalue="{value_city}">
						<option value="">{hint_city}</option>
					</select>
					<div id="user_city_customInput" style="display: none;">
						<input type="text" name="user_city_input" id="user_city_custom" data-clear-btn="true" value="{value_city}" />
					</div>
					<div class="ui-field-contain">
						<label for="user_birth">{title_birth}</label>
						<input type="date" name="user_birth" id="user_birth" data-clear-btn="true" value="{value_birth}" />
					</div>
					<label for="user_why">{label_why}</label>
					<textarea cols="40" rows="8" name="user_why" id="user_why" placeholder="{hint_why}" maxlength="200">{value_why}</textarea>
					<label for="user_what">{label_what}</label>
					<textarea cols="40" rows="8" name="user_what" id="user_what" placeholder="{hint_what}" maxlength="200">{value_what}</textarea>
					<input type="submit" name="info" value="{button_confirm}" data-theme="b" />
				</form>
			</div>
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
var var_location_list = null;
var var_select_country = null;
var var_select_city = null;
var var_location_loaded = false;

function internalCountryChanged() {
	var var_disable_city = (var_select_country.val().length == 0);
	
	var_select_city.empty();
	var_select_city.textinput({disabled: var_disable_city});
	var_select_city.append(new Option("{hint_city}", ""));
	if (var_disable_city == false) {
		var var_city_list = null;
		var var_temp_dom = null;
		var var_country_value = var_select_country.data("oldvalue");
		var var_country_current = var_select_country.val();
		var var_city_value = var_select_city.data("oldvalue");
		var var_same_country = (var_country_value == var_country_current);
		var var_city_custom = (var_city_value != "" && var_same_country);
		
		var_city_list = var_location_list[var_select_country.val()].sort();
		// make JS redundancy to win more performance
		if (var_city_custom) {
			$.each(var_city_list, function(var_i, var_cityName) {
				if (var_cityName.length > 0) {
					var var_selected = (var_cityName == var_city_value);
					
					var_temp_dom += (new Option(var_cityName, var_cityName, var_selected)).outerHTML;
					if (var_selected == true) {
						var_city_custom = false;
					}
				}
			});
		}
		else {
			$.each(var_city_list, function(var_i, var_cityName) {
				if (var_cityName.length > 0) {
					var_temp_dom += (new Option(var_cityName, var_cityName)).outerHTML;;
				}
			});
		}
		var_temp_dom += (new Option("{hint_not_found}", "_NOT_FOUND_IN_LIST_", var_city_custom)).outerHTML;
		var_select_city.append(var_temp_dom);
		var_select_city.val((var_city_custom ? "_NOT_FOUND_IN_LIST_" : (var_same_country ? var_city_value : "")));
	}
	var_select_city.trigger("change");
	
	// spinner off
	$("#overlay").removeClass("gray-overlay");
	$(".ui-loader").css("display", "none");
	
	return;
}

function onCountryChanged() {
	if (var_location_list != null) {
		// spinner on
		$("#overlay").addClass("gray-overlay");
		$(".ui-loader").css("display", "block");
		
		// wait for spinner
		setTimeout(internalCountryChanged, 500);
	}
	else {
		console.log("error case");
		load_locationList();
	}
	
	return;
}

function onCityChanged() {
	var var_citySelected = var_select_city.val();
	
	var_select_city.parent().children("span").removeClass();
	if (var_citySelected == "_NOT_FOUND_IN_LIST_") {
		$("input#user_city_custom").val((
				(var_select_country.data("oldvalue") == var_select_country.val())
				? var_select_city.data("oldvalue") : ""));
		
		$("div#user_city_customInput").show();
		$("input#user_city_custom").textinput({disabled: false});
	}
	else {
		$("div#user_city_customInput").hide();
		$("input#user_city_custom").textinput({disabled: true});
	}
	
	return;
}

function load_locationList() {
	$.ajax({
		url: "/assets/countriesToCities.json",
		cache: true,
		dataType: "json",
		beforeSend: function() {
			$("#overlay").addClass("gray-overlay");
			$(".ui-loader").css("display", "block");
		},
		success: function(data) {
			var var_country_list = [];
			var var_country_value = var_select_country.data("oldvalue");
			var var_temp_dom = null;
			
			var_location_list = data;
			
			// add country into list
			if (typeof(Object.keys) == "function") {
				var_country_list = Object.keys(var_location_list);
			}
			else {
				$.each(var_location_list, function(var_country, var_cityList) {
					var_country_list.push(var_country);
				});
			}
			var_country_list.sort();
			$.each(var_country_list, function(var_i, var_countryName) {
				if (var_countryName.length > 0) {
					var_temp_dom += (new Option(var_countryName, var_countryName)).outerHTML;
				}
			});
			var_select_country.append(var_temp_dom);
			var_select_country.val(var_country_value);
			
			var_select_country.change(onCountryChanged);
			var_select_city.change(onCityChanged);
			var_select_country.trigger("change");
		},
		error: function() {
			var_location_list = null;
			// clear spinner if error?
			$("#overlay").removeClass("gray-overlay");
			$(".ui-loader").css("display", "none");
		},
	});
	
	return;
}

$("div#account_menu_profile").on("collapsibleexpand",function() {
	if (var_location_loaded == false) {
		var_location_loaded = true;
		
		var_select_country = $("select#user_country");
		var_select_city = $("select#user_city");
		
		var_select_city.textinput({disabled: true});
		$("input#user_city_custom").textinput({disabled: true});
		load_locationList();
	}
});

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