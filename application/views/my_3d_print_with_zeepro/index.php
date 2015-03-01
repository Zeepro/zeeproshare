<style type="text/css">
	.ui-short-textinput {
		width: 200px;
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
				<input type="text" id="address1" name="address1" value="" placeholder="{address}">
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
			    <input type="text" name="cell_phone" value="" placeholder="{cell_phone}">
			    <fieldset data-role="controlgroup" data-type="horizontal">
			        <legend>{3D_printer_owner}</legend>
			        <input name="3D_printer_owner" id="3D_printer_owner_yes" value="on" type="radio">
			        <label for="3D_printer_owner_yes">{yes}</label>
			        <input name="3D_printer_owner" id="3D_printer_owner_no" value="off" type="radio">
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
			    <fieldset data-role="controlgroup" data-type="horizontal">
			        <legend>{ever_use}</legend>
			        <input name="ever_use_3D_printer" id="ever_use_3D_printer_yes" value="on" type="radio">
			        <label for="ever_use_3D_printer_yes">{yes}</label>
			        <input name="ever_use_3D_printer" id="ever_use_3D_printer_no" value="off" type="radio">
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
			    	<input type="text" name="websiteURL" value="" placeholder="{websiteURL}">
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
         			<div class="ui-block-a" style="width: 155px;">
						<input type="checkbox" name="tos" id="tos" data-mini="true">
						<label for="tos" style="background-color: transparent;border-width:0">{I_agree} </label>
         			</div>
					<div class="ui-block-b">
						<div style="padding-top: 13px;">
							<a href="/my_3d_print_with_zeepro/terms_of_service" data-ajax="false" style="font-weight: normal;color: #000; text-shadow: 0 1px 0 #fff">{terms_of_service}</a>
						</div>
         			</div>
				</div>         			
				<input type="submit" name="submit" value="<?php echo t('apply') ?>" data-theme="b"  />
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("form").on("submit", function()
	{
		$("#overlay").addClass("gray-overlay");
		$(".ui-loader").css("display", "block");
	});
	$("header.page-header").html('<a href="javascript:history.back();" data-role="button" data-theme="b" data-icon="back" data-ajax="false">{back}</a>')
	$("#ThreeDprinterDiv").hide();
	$("#websiteURLDiv").hide();
	$("#social_media_customDiv").hide();
	$("#3D_printer_owner_yes").bind("click", function(event, ui) {
		$("#ThreeDprinterDiv").show("fast");
	});
	$("#3D_printer_owner_no").bind("click", function(event, ui) {
		$("#ThreeDprinterDiv").hide("fast");
	});
	$("#criteriaA").change(function () {
		if($(this).val() != "{criteriaA04}")
			$("#websiteURLDiv").show("fast");
		else
			$("#websiteURLDiv").hide("fast");
	});
	$("#social_media").change(function () {
		if($(this).val() == "{social_media06}")
			$("#social_media_customDiv").show("fast");
		else
			$("#social_media_customDiv").hide("fast");
	});
</script>