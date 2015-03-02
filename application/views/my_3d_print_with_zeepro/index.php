<style type="text/css">
	.ui-short-textinput {
		width: 200px;
	}
	.floatright {
	    float:right;
	 }
	 .closespacing { /* controls spacing between elements */
	    margin:0px 5px 0px 0px;
	 }
	 .miniinputheight { /* matches text input height to minibuttons */
	    padding-top:5px !important;
	    padding-bottom:5px !important;
	}
</style>
<div class="content-wrapper">
	<h2>{title}</h2>
	<div class="ui-grid-b ui-corner-all ui-shadow ui-transparent" style="padding: 5px; padding-bottom: 25px; color: #000; text-shadow: 0 1px 0 #fff">
		<div id="error"><?php $this->load->helper('form'); echo validation_errors('<p class="zim-error">', '</p>'); ?>{custom_error}</div>
		<div data-role="fieldcontain">
			<form action="/my_3d_print_with_zeepro" method="post" accept-charset="utf-8" data-ajax="false">
				<input type="text" id="email" name="email" value="" placeholder="{email}">
				<input type="text" id="first_name" name="first_name" value="" placeholder="{first_name}">
				<input type="text" id="last_name" name="last_name" value="" placeholder="{last_name}">
				<br/>
				<input type="text" id="address1" name="address1" value="" placeholder="{address}" class='miniinputheight'>
				<div id="home_popup" data-role="popup" class="ui-content">
					<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right"></a>
					{why_address}
				</div>
				<input type="text" id="address2" name="address2" value="" placeholder="{address}">
				<input type="text" id="city" name="city" value="" placeholder="{city}">
				<input type="text" id="state" name="state" value="" placeholder="{state}">
				<input type="text" id="zip" name="zip" value="" placeholder="{zip}" class="ui-short-textinput">
				<select name="country" id="country" data-native-menu="false">
					<option value="choose-one" data-placeholder="true">{country}</option>
			        <option value="1">{country01}</option>
			        <option value="2">{country02}</option>
			        <option value="3">{country03}</option>
			        <option value="4">{country04}</option>
			    </select>
				<br/>
			    <input type="text" id="cell_phone" name="cell_phone" value="" placeholder="{cell_phone}" data-type="phone">
			    <fieldset id="3D_printer_owner" data-role="controlgroup" data-type="horizontal">
			        <legend>{3D_printer_owner}</legend>
			        <input name="3D_printer_owner" id="3D_printer_owner_yes" value="yes" type="radio">
			        <label for="3D_printer_owner_yes">{yes}</label>
			        <input name="3D_printer_owner" id="3D_printer_owner_no" value="no" type="radio">
			        <label for="3D_printer_owner_no">{no}</label>
			    </fieldset>
			    <div id="ThreeDprinterDiv">
				    <select name="ThreeDprinter" id="ThreeDprinter" data-native-menu="false">
				        <option value="1">{ThreeDprinter01}</option>
				        <option value="2">{ThreeDprinter02}</option>
				        <option value="3">{ThreeDprinter03}</option>
				        <option value="4">{ThreeDprinter04}</option>
				    </select>
			    </div>
			    <fieldset id="ever_use_3D_printer" data-role="controlgroup" data-type="horizontal">
			        <legend>{ever_use}</legend>
			        <input name="ever_use_3D_printer" id="ever_use_3D_printer_yes" value="yes" type="radio">
			        <label for="ever_use_3D_printer_yes">{yes}</label>
			        <input name="ever_use_3D_printer" id="ever_use_3D_printer_no" value="no" type="radio">
			        <label for="ever_use_3D_printer_no">{no}</label>
			    </fieldset>
			    <select name="criteriaA" id="criteriaA" data-native-menu="false">
					<option value="choose-one" data-placeholder="true">{criteriaA}</option>
			    	<option value="{criteriaA01}">{criteriaA01}</option>
			        <option value="{criteriaA02}">{criteriaA02}</option>
			        <option value="{criteriaA03}">{criteriaA03}</option>
			        <option value="{criteriaA04}">{criteriaA04}</option>
			    </select>
			    <div id="websiteURLDiv">
			    	<input type="text" id="websiteURL" name="websiteURL" value="" placeholder="{websiteURL}">
			    </div>
			    <select name="criteriaB" id="criteriaB" data-native-menu="false">
					<option value="choose-one" data-placeholder="true">{criteriaB}</option>
			    	<option value="{criteriaB01}">{criteriaB01}</option>
			        <option value="{criteriaB02}">{criteriaB02}</option>
			        <option value="{criteriaB03}">{criteriaB03}</option>
			    </select>
			    <select name="social_media" id="social_media" data-native-menu="false">
					<option value="choose-one" data-placeholder="true">{social_media}</option>
			    	<option value="{social_media01}">{social_media01}</option>
			        <option value="{social_media02}">{social_media02}</option>
			        <option value="{social_media03}">{social_media03}</option>
			        <option value="{social_media04}">{social_media04}</option>
			        <option value="{social_media05}">{social_media05}</option>
			        <option value="{social_media06}">{social_media06}</option>
				</select>
			    <div id="social_media_customDiv">
					<input type="text" name="social_media_custom" value="" placeholder="{social_media_custom}">
				</div>
				<input type="text" name="handle" value="" placeholder="{handle}">
				<div class="ui-grid-a">
         			<div class="ui-block-a" style="width: 50px;">
						<input type="checkbox" name="tos" id="tos" data-mini="true">
         			</div>
					<div class="ui-block-b">
						<a id="agree"  href="/my_3d_print_with_zeepro/terms_of_service" data-ajax="false" style="font-weight: normal;color: #000; text-shadow: 0 1px 0 #fff" target="_blank" >{terms_of_service_agreement}</a>
         			</div>
				</div>         			
				<input type="submit" name="submit" value="<?php echo t('apply') ?>" data-theme="b"  />
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("header.page-header").html('<a href="javascript:history.back();" data-role="button" data-theme="b" data-icon="back" data-ajax="false">{back}</a>')
	$("#ThreeDprinterDiv").hide();
	$("#websiteURLDiv").hide();
	$("#social_media_customDiv").hide();
	$("#3D_printer_owner_yes").bind("click", function(event, ui) {
		$("#ThreeDprinterDiv").show("slow");
	});
	$("#3D_printer_owner_no").bind("click", function(event, ui) {
		$("#ThreeDprinterDiv").hide("slow");
	});
	$("#criteriaA").change(function () {
		if($(this).val() != "{criteriaA04}")
			$("#websiteURLDiv").show("slow");
		else
			$("#websiteURLDiv").hide("slow");
	});
	$("#social_media").change(function () {
		if($(this).val() == "{social_media06}")
			$("#social_media_customDiv").show("slow");
		else
			$("#social_media_customDiv").hide("slow");
	});
	$("#email").focusout(function() {
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if($(this).val() == '' || !emailReg.test($(this).val()))
			$(this).parent().closest('div').css('border-color', '#f00')
		else
			$(this).parent().closest('div').css('border-color', '#ddd');
	});
	$("#first_name").focusout(function() {
		if($(this).val() == '')
			$(this).parent().closest('div').css('border-color', '#f00')
		else
			$(this).parent().closest('div').css('border-color', '#ddd');
	});
	$("#last_name").focusout(function() {
		if($(this).val() == '')
			$(this).parent().closest('div').css('border-color', '#f00')
		else
			$(this).parent().closest('div').css('border-color', '#ddd');
	});
	$("#address1").focusout(function() {
		if($(this).val() == '')
			$(this).parent().closest('div').css('border-color', '#f00')
		else
			$(this).parent().closest('div').css('border-color', '#ddd');
	});
	$("#city").focusout(function() {
		if($(this).val() == '')
			$(this).parent().closest('div').css('border-color', '#f00')
		else
			$(this).parent().closest('div').css('border-color', '#ddd');
	});
	$("#state").focusout(function() {
		if($(this).val() == '')
			$(this).parent().closest('div').css('border-color', '#f00')
		else
			$(this).parent().closest('div').css('border-color', '#ddd');
	});
	$("#zip").focusout(function() {
		if($(this).val() == '')
			$(this).parent().closest('div').css('border-color', '#f00')
		else
			$(this).parent().closest('div').css('border-color', '#ddd');
	});
	$("#country").change(function() {
		$("#country-button").css('border-color', '#ddd')
	});	
	$("#cell_phone").focusout(function() {
		var phoneReg = /^[ 0-9]+$/;
		if($(this).val() == '' || !phoneReg.test($(this).val()))
			$(this).parent().closest('div').css('border-color', '#f00')
		else
			$(this).parent().closest('div').css('border-color', '#ddd');
	});
	$("#3D_printer_owner_yes").click(function() {
		$("#3D_printer_owner").css('color', '#000');
	});
	$("#3D_printer_owner_no").click(function() {
		$("#3D_printer_owner").css('color', '#000');
	});
	$("#ever_use_3D_printer_yes").click(function() {
		$("#ever_use_3D_printer").css('color', '#000');
	});
	$("#ever_use_3D_printer_no").click(function() {
		$("#ever_use_3D_printer").css('color', '#000');
	});
	$("#criteriaA").change(function() {
		$("#criteriaA-button").css('border-color', '#ddd')
	});	
	$("#websiteURL").focusout(function() {
		if($(this).val() == '')
			$(this).parent().closest('div').css('border-color', '#f00')
		else
			$(this).parent().closest('div').css('border-color', '#ddd');
	});
	$("#criteriaB").change(function() {
		$("#criteriaB-button").css('border-color', '#ddd')
	});	
	$("#social_media").change(function() {
		$("#social_media-button").css('border-color', '#ddd')
	});	
	$("#tos").click(function() {
		$("#agree").css('color', '#000')
	});	
	$("form").on("submit", function() {
		var hasError = false;
		if ($("#email").val() == '') {
			$("#email").parent().closest('div').css('border-color', '#f00');
			hasError = true;
		}
		if ($("#first_name").val() == '') {
			$("#first_name").parent().closest('div').css('border-color', '#f00');
			hasError = true;
		}
		if ($("#last_name").val() == '') {
			$("#last_name").parent().closest('div').css('border-color', '#f00');
			hasError = true;
		}
		if ($("#address1").val() == '') {
			$("#address1").parent().closest('div').css('border-color', '#f00');
			hasError = true;
		}
		if ($("#city").val() == '') {
			$("#city").parent().closest('div').css('border-color', '#f00');
			hasError = true;
		}
		if ($("#state").val() == '') {
			$("#state").parent().closest('div').css('border-color', '#f00');
			hasError = true;
		}
		if ($("#zip").val() == '') {
			$("#zip").parent().closest('div').css('border-color', '#f00');
			hasError = true;
		}
		if ($("#country").val() == 'choose-one') {
			$("#country-button").css('border-color', '#f00');
			hasError = true;
		}
		var phoneReg = /^[ 0-9]+$/;
		if ($("#cell_phone").val() == '' || !phoneReg.test($("#cell_phone").val())) {
			$("#cell_phone").parent().closest('div').css('border-color', '#f00');
			hasError = true;
		}
		if ($("input[type='radio'][name='3D_printer_owner']:checked").length == 0) {
			$("#3D_printer_owner").css('color', '#f00');
			hasError = true;
		} else {
//			alert($("input[type='radio'][name='3D_printer_owner']:checked").val());				
		}			
		if ($("input[type='radio'][name='ever_use_3D_printer']:checked").length == 0) {
			$("#ever_use_3D_printer").css('color', '#f00');
			hasError = true;
		}			
		if ($("#criteriaA").val() == 'choose-one') {
			$("#criteriaA-button").css('border-color', '#f00');
			hasError = true;
		} else if ($("#criteriaA").val() != '{criteriaA04}' && $("#websiteURL").val() == ''){
			$("#websiteURL").parent().closest('div').css('border-color', '#f00');
			hasError = true;
}
		if ($("#criteriaB").val() == 'choose-one') {
			$("#criteriaB-button").css('border-color', '#f00');
			hasError = true;
		}
		if ($("#social_media").val() == 'choose-one') {
			$("#social_media-button").css('border-color', '#f00');
			hasError = true;
		}
		if (!$("#tos").is(':checked')) {
			$("#agree").css('color', '#f00');
			hasError = true;
		}
		if (hasError)
			return false;
		
		$("#overlay").addClass("gray-overlay");
		$(".ui-loader").css("display", "block");
	});
	</script>