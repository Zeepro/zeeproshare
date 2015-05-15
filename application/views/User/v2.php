<style type="text/css">
	h2 {
		color: #000;
		text-shadow: 0 1px #FFF;
	}
	p.wait_message {
		color: #000;
		text-shadow: 0 1px #FFF;
		text-align: center;
	}
</style>
<script type="text/javascript" src="/assets/jssor/jssor.slider.mini.js"></script>
<link rel="stylesheet" href="/assets/jssor/jssora.css" />
<div id="confirm_v2" data-role="popup" data-position-to="window" class="ui-content">
	<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right"></a>
	<div data-role="content">
	    <p>{areyousure}</p>
	    <a href="javascript:disconnect()" data-role="button" data-theme="b" data-ajax="false">{yes}</a>
	    <a href="#" data-role="button" data-theme="c" data-rel="back">{no}</a>
	</div>
</div>
<div class="content-wrapper">
	<div class="ui-grid-b ui-corner-all ui-shadow ui-transparent" style="padding: 5px;">
		<div id="user_printerUpgrade" style="display: none; text-align: center;">
			<a href="#" onclick="javascript: do_upgrade();" style="color: red; font-weight: bold; font-size: larger; text-shadow: 0 1px #FFF;">{msg_upgrade}</a>
			<div id="printer_upgrade_popup" data-role="popup" class="ui-content" style="width: 640px; max-width: 90%; text-align: center;">
				<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right"></a>
				<ul data-role="listview" class="shadowBox" data-inset="true">
				{upgrades_display}
					<li><a href="#" id="user_multiUpgrade_item_{id}" data-rel="back" data-v1system="{v1system}"
							data-token="{token}" data-rdvurl="{rdv_url}" data-locip="{loc_ip}"
							onclick="javascript: if(do_assign(this.id)) do_submit('printerstate/upgradenote', {reboot:''});">
						<h2>{name}</h2>
					</a></li>
				{/upgrades_display}
				</ul>
			</div>
		</div>
		<h2>{news}</h2>
		<p id="news_wait_msg" class="wait_message">{msg_load_wait}</p>
		<ul data-role="none" id="news_list" style="text-shadow: 0 1px #FFF;"></ul>
		<h2>{inspiration}</h2>
		<p id="inspiration_wait_msg" class="wait_message">{msg_load_wait}</p>
		<!-- Jssor Slider Begin -->
		<div id="jssor_slider_container" style="display: none; position: relative; top: 0px; left: 0px; width: 800px; height: 300px; overflow: hidden; margin: 0px auto;">
			<div id="slider_image" u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 800px; height: 300px; overflow: hidden;"></div>
			<span u="arrowleft" class="jssora13l" style="width: 40px; height: 50px; top: 123px; left: 30px;"></span>
			<span u="arrowright" class="jssora13r" style="width: 40px; height: 50px; top: 123px; right: 30px"></span>
		</div>
		<!-- Jssor Slider End -->
		<h2>{myzeeproshare}</h2>
		<div class="widget_user_monoPrinter" style="display: none;">
			<ul data-role="listview" class="shadowBox" data-inset="true">
				<li><a href="#" onclick="javascript: do_submit('menu/m_print');"><h2>{link_print}</h2></a></li>
				<li><a href="#" onclick="javascript: do_submit('menu/m_config');"><h2>{link_config}</h2></a></li>
				<li><a href="/user/account"><h2>{link_account}</h2></a>
			</ul>
		</div>
		<div class="widget_user_multiPrinter" style="display: none;">
			<ul data-role="listview" class="shadowBox" data-inset="true">
				{multi_printers}
				<li><a href="#" id="user_multiPrinter_item_{id}" data-rel="popup" data-v1system="{v1system}"
						onclick="javascript: do_assign(this.id, 'printer_menu_popup');"
						data-token="{token}" data-rdvurl="{rdv_url}" data-locip="{loc_ip}">
				<h2>{name}</h2>
				</a></li>
				{/multi_printers}
				<li><a href="/user/account"><h2>{link_account}</h2></a>
			</ul>
		</div>
		<h2>{channels}</h2>
		<a style="margin-top: 20px;" href="/user/share" data-role="button" data-theme="b" data-ajax="false">{share}</a>
		<a href="/user/follow" data-role="button" data-theme="b" data-ajax="false">{follow}</a>
		<a href="http://zeepro.com/collections/all/products/pla-filament-cartridge" target="_blank" data-role="button" data-theme="b" data-ajax="false">{store}</a>
<!-- 		<a href="/user/support" data-role="button" data-theme="b" data-ajax="false">{support}</a> -->
		<a href="#support_menu_popup" data-role="button" data-rel="popup" data-theme="b">{support}</a>
		<div id="user_hiddenform2submit_container" style="display: none;">
			<form id="user_hiddenform2submit" method="POST">
				<input type="hidden" name="token" />
				<input type="hidden" name="user" value="{user_token}" />
				<input type="hidden" name="redirect" />
			</form>
		</div>
	</div>
</div>
<div id="printer_menu_popup" data-role="popup" class="ui-content" style="width: 640px; max-width: 90%; text-align: center;">
	<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right"></a>
	<ul data-role="listview" class="shadowBox" data-inset="true">
		<li><a href="#"  data-rel="back" onclick="javascript: do_submit('menu/m_print');"><h2>{link_print}</h2></a></li>
		<li><a href="#"  data-rel="back" onclick="javascript: do_submit('menu/m_config');"><h2>{link_config}</h2></a></li>
	</ul>
</div>
<div id="support_menu_popup" data-role="popup" class="ui-content" style="width: 640px; max-width: 90%; text-align: center;">
	<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right"></a>
	<ul data-role="listview" class="shadowBox" data-inset="true">
		<li><a href="/user/support"><h2>{link_tutorial}</h2></a></li>
		<li><a href="http://zimsupport.zeepro.com/support/home" target="_blank" onclick="javascript: do_closeSupport();"><h2>{link_faq}</h2></a></li>
		<li><a href="http://zimsupport.zeepro.com/support/tickets/new" target="_blank" onclick="javascript: do_closeSupport();"><h2>{link_support}</h2></a></li>
	</ul>
</div>

<script>
var var_user_multi_printer = {user_multi_printer};
var var_user_token = '{user_token}';
var var_submit_token = '{mono_printer_token}';
var var_submit_rdvURL = '{mono_printer_rdv_url}';
var var_submit_locIP = '{mono_printer_loc_ip}';
var var_submit_v1System = {mono_printer_v1system};
var var_show_upgrade = {show_upgrade};

function disconnect() {
	$("#overlay").addClass('gray-overlay');
	$(".ui-loader").css("display", "block");
	window.location = "/login/disconnect";
};

function do_assign(var_a_id, var_popup_id) {
	if (typeof(var_a_id) == "undefined"
			|| typeof($("a#" + var_a_id).data("locip")) == "undefined") {
		console.log("assign source not found");
		
		return false;
	}
	
	var_submit_token = $("a#" + var_a_id).data("token");
	var_submit_rdvURL = $("a#" + var_a_id).data("rdvurl");
	var_submit_locIP = $("a#" + var_a_id).data("locip");
	var_submit_v1System = $("a#" + var_a_id).data("v1system");
	
	if ($("a#" + var_a_id).data("v1system") == true) {
		do_submit(); // do submit action directly for v1 system
		
		return false;
	}
	else if (typeof(var_popup_id) != "undefined"
			&& $("a#" + var_a_id).data("v1system") === false
			&& "popup" == $("div#" + var_popup_id).data("role")) {
		$("div#" + var_popup_id).popup("open");
	}
	
	return true;
}

function do_upgrade() {
	if (var_user_multi_printer == false) {
		do_submit('printerstate/upgradenote', {reboot:""});
	}
	else {
		$("div#printer_upgrade_popup").popup("open");
	}
	
	return;
}

function do_closeSupport() {
	$("div#support_menu_popup").popup("close");
	
	return;
}

function do_submit(var_redirectURL, var_redirectPrm) {
	if (typeof(var_redirectURL) == "undefined") var_redirectURL = "";
	
	// load test image
	var var_testImg = new Image();
	var_testImg.src = "http://" + var_submit_locIP + "/images/pixel.png?_=" + Date.now();
	
	// start spinner
	$("#overlay").addClass('gray-overlay');
	$(".ui-loader").css("display", "block");
	
	setTimeout(function() {
		var var_form_selector = "form#user_hiddenform2submit";
		
		if (var_testImg.height > 0) { // local case
			if (var_submit_v1System) {
				var var_get_prm = "?from=redirect";
				
				if (typeof(var_redirectPrm) == "object") {
					$.each(var_redirectPrm, function(key, value) {
						var_get_prm = var_get_prm + "&" + key + "=" + value;
					});
				}
				window.location.href = "http://" + var_submit_locIP + "/" + var_redirectURL + var_get_prm;
			}
			else {
// 				// CORS check
// 				$.ajax({
// 					url: "http://" + var_submit_locIP + "/set_cookie/user",
// 					cache: false,
// 					async: true,
// 					xhrFields: {
// 						withCredentials: true,
// 					},
// 					success: function() {
// 						var var_get_prm = "?from=redirect";
						
// 						console.log("CORS and verification ok, pass directly without token");
// 						if (typeof(var_redirectPrm) == "object") {
// 							$.each(var_redirectPrm, function(key, value) {
// 								var_get_prm = var_get_prm + "&" + key + "=" + value;
// 							});
// 						}
// 						window.location.href = "http://" + var_submit_locIP + "/" + var_redirectURL + var_get_prm;
// 					},
// 					error: function() {
						if (var_redirectURL.length) {
							var var_redirect_json = {
								url: "/" + var_redirectURL,
							};
							
							if (typeof(var_redirectPrm) == "object") {
								var_redirect_json.prm = var_redirectPrm;
							}
							$(var_form_selector + " input[name=redirect]").val(JSON.stringify(var_redirect_json));
						}
						else {
							$(var_form_selector + " input[name=redirect]").prop("disabled", true);
						}
						$(var_form_selector).attr("action", "http://" + var_submit_locIP + "/set_cookie/user");
						$(var_form_selector + " input[name=token]").prop("disabled", true);
						
						$(var_form_selector).submit();
// 					}
// 				});
			}
		}
		else { // remote case
			if (var_submit_v1System) {
				$(var_form_selector + " input[name=token]").val(var_submit_token);
			}
			else {
				var var_token_json = {
					token: var_submit_token,
					user: var_user_token,
					redirect: {
						url: "/" + var_redirectURL,
					},
				};
				
				if (var_redirectURL.length) {
					var_token_json.redirect = {
							url: "/" + var_redirectURL,
					};
					if (typeof(var_redirectPrm) == "object") {
						var_token_json.prm = var_redirectPrm;
					}
				}
				$(var_form_selector + " input[name=token]").val(JSON.stringify(var_token_json));
			}
			
			$(var_form_selector).attr("action", "https://" + var_submit_rdvURL + "/set_cookie");
			$(var_form_selector + " input[name=user]").prop('disabled', true);
			$(var_form_selector + " input[name=redirect]").prop('disabled', true);
			
			$(var_form_selector).submit();
		}
		
		// remove spinner if js has time
		$("#overlay").addClass('gray-overlay');
		$(".ui-loader").css("display", "block");
	}, 3000);
	
	return;
}

function initializeSlider() {
	var options = {
		$AutoPlay: true,
		$PauseOnHover: 1,
		$ArrowKeyNavigation: true,
		$SlideWidth: 600,
		$SlideSpacing: 0,
		$DisplayPieces: 2,
		$ParkingPosition: 100,
		$ArrowNavigatorOptions: {
			$Class: $JssorArrowNavigator$,
			$ChanceToShow: 2,
			$AutoCenter: 2,
			$Steps: 1
		}
	};
	
	var jssor_slider_image = new $JssorSlider$("jssor_slider_container", options);
	
	// scale the slider while window resizes
	function ScaleSlider() {
		var parentWidth = jssor_slider_image.$Elmt.parentNode.clientWidth;
		if (parentWidth)
			jssor_slider_image.$ScaleWidth(Math.min(parentWidth, 800));
		else
			window.setTimeout(ScaleSlider, 30);
	}
	ScaleSlider();
	
	$(window).bind("load", ScaleSlider);
	$(window).bind("resize", ScaleSlider);
	$(window).bind("orientationchange", ScaleSlider);
}

// differ mono or multi printer
if (var_user_multi_printer) {
	$("div.widget_user_multiPrinter").show();
}
else {
	$("div.widget_user_monoPrinter").show();
}
if (var_show_upgrade) {
	$("div#user_printerUpgrade").show();
}

// add logout button
$("header.page-header").html('<a href="#confirm_v2" data-rel="popup" data-transition="pop" data-icon="power" data-iconpos="notext" class="ui-btn-right" data-theme="b"></a>');

// load rss
$(document).ready(function() {
	$.ajax({
		url: "/user/rss_ajax?news",
		dataType: "xml",
// 		async: false,
		success: function(data) {
			$(data).find("item").each(function() {
				var ele_news = $(this);
				var news_url = ele_news.find("link").text();
				var news_alt = ele_news.find("description").text();
				var news_text = ele_news.find("title").text();
				$("ul#news_list").append('<li><a href="' + news_url + '" target="_blank" title="' + news_alt + '">' + news_text + '</a></li>');
			});
			
			$("ul#news_list").append('<li><a href="http://zeepro.com/blogs/news" target="_blank"><span style="font-size: smaller;">{link_news_more}</span></a></li>');
			$("p#news_wait_msg").hide();
		}
	});
	
	$.ajax({
			url: "/user/rss_ajax?model",
			dataType: "xml",
// 			async: false,
			success: function(data) {
				$(data).find("item").each(function() {
					var ele_image = $(this);
					var image_url = ele_image.find("link").text();
					var image_src = ele_image.find("description").text();
					var image_alt = ele_image.find("title").text();
					$("div#slider_image").append('<div><a href="' + image_url + '"><img u="image" alt="' + image_alt + '" src="' + image_src + '" /></div>');
				});
				
				initializeSlider();
				$("div#jssor_slider_container").show();
				$("p#inspiration_wait_msg").hide();
			}
	});
});
</script>