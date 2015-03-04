<style type="text/css">
	.ui-selectmenu.ui-popup .ui-input-search {
	    margin-left: .5em;
	    margin-right: .5em;
	}
	.ui-selectmenu.ui-dialog .ui-content {
	    padding-top: 0;
	}
	.ui-selectmenu.ui-dialog .ui-selectmenu-list {
	    margin-top: 0;
	}
	.ui-selectmenu.ui-popup .ui-selectmenu-list li.ui-first-child .ui-btn {
	    border-top-width: 1px;
	    -webkit-border-radius: 0;
	    border-radius: 0;
	}
	.ui-selectmenu.ui-dialog .ui-header {
	    border-bottom-width: 1px;
	}
</style>
<div class="content-wrapper">
	<h2>{title}</h2>
	<div class="ui-grid-b ui-corner-all ui-shadow ui-transparent"
		style="padding: 5px; padding-bottom: 25px; color: #000; text-shadow: 0 1px 0 #fff">
		<div style="padding:20px; text-shadow: 0 1px 0 #ccc">{description}</div>
		<div data-role="fieldcontain" style="margin-top:0px;">
			<form action="/my_3d_print_with_zeepro" method="post"
				accept-charset="utf-8" data-ajax="false">
				<input type="text" id="email" name="email" value=""
					placeholder="{email}">
				<input type="text" id="first_name"
					name="first_name" value="" placeholder="{first_name}">
				<input type="text" id="last_name" name="last_name" value=""
					placeholder="{last_name}">
				<br />
				<div class="ui-grid-a">
					<div class="ui-block-b" style="float:right; width:15%">
						<a href="#address_why_popup" data-rel="popup" class="ui-btn ui-corner-all ui-shadow" data-transition="pop" style="height:14px; padding-top:9px; padding-left:14px">?</a>
						<div id="address_why_popup" data-role="popup" class="ui-content">
							<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-left"></a>
							{why_address}
						</div>
					</div>
					<div class="ui-block-a" style="width:85%">
						<input type="text" id="address1" name="address1" value="" placeholder="{address1}">
					</div>
				</div>
				<input type="text"
					id="address2" name="address2" value="" placeholder="{address2}">
				<input
					type="text" id="city" name="city" value="" placeholder="{city}">
				<input
					type="text" id="state" name="state" value="" placeholder="{state}">
				<input type="text" id="zip" name="zip" value="" placeholder="{zip}"
					class="ui-short-textinput">
				<select name="country" id="country"
					data-native-menu="false">
					<option value="choose-one" data-placeholder="true">{country}</option>
					<option value="{country255}">{country255}</option>
					<option value="{country001}">{country001}</option>
					<option value="{country002}">{country002}</option>
					<option value="{country003}">{country003}</option>
					<option value="{country004}">{country004}</option>
					<option value="{country005}">{country005}</option>
					<option value="{country006}">{country006}</option>
					<option value="{country007}">{country007}</option>
					<option value="{country008}">{country008}</option>
					<option value="{country009}">{country009}</option>
					<option value="{country010}">{country010}</option>
					<option value="{country011}">{country011}</option>
					<option value="{country012}">{country012}</option>
					<option value="{country013}">{country013}</option>
					<option value="{country014}">{country014}</option>
					<option value="{country015}">{country015}</option>
					<option value="{country016}">{country016}</option>
					<option value="{country017}">{country017}</option>
					<option value="{country018}">{country018}</option>
					<option value="{country019}">{country019}</option>
					<option value="{country020}">{country020}</option>
					<option value="{country021}">{country021}</option>
					<option value="{country022}">{country022}</option>
					<option value="{country023}">{country023}</option>
					<option value="{country024}">{country024}</option>
					<option value="{country025}">{country025}</option>
					<option value="{country026}">{country026}</option>
					<option value="{country027}">{country027}</option>
					<option value="{country028}">{country028}</option>
					<option value="{country029}">{country029}</option>
					<option value="{country030}">{country030}</option>
					<option value="{country031}">{country031}</option>
					<option value="{country032}">{country032}</option>
					<option value="{country033}">{country033}</option>
					<option value="{country034}">{country034}</option>
					<option value="{country035}">{country035}</option>
					<option value="{country036}">{country036}</option>
					<option value="{country037}">{country037}</option>
					<option value="{country038}">{country038}</option>
					<option value="{country039}">{country039}</option>
					<option value="{country040}">{country040}</option>
					<option value="{country041}">{country041}</option>
					<option value="{country042}">{country042}</option>
					<option value="{country043}">{country043}</option>
					<option value="{country044}">{country044}</option>
					<option value="{country045}">{country045}</option>
					<option value="{country046}">{country046}</option>
					<option value="{country047}">{country047}</option>
					<option value="{country048}">{country048}</option>
					<option value="{country049}">{country049}</option>
					<option value="{country050}">{country050}</option>
					<option value="{country051}">{country051}</option>
					<option value="{country052}">{country052}</option>
					<option value="{country053}">{country053}</option>
					<option value="{country054}">{country054}</option>
					<option value="{country055}">{country055}</option>
					<option value="{country056}">{country056}</option>
					<option value="{country057}">{country057}</option>
					<option value="{country058}">{country058}</option>
					<option value="{country059}">{country059}</option>
					<option value="{country060}">{country060}</option>
					<option value="{country061}">{country061}</option>
					<option value="{country062}">{country062}</option>
					<option value="{country063}">{country063}</option>
					<option value="{country064}">{country064}</option>
					<option value="{country065}">{country065}</option>
					<option value="{country066}">{country066}</option>
					<option value="{country067}">{country067}</option>
					<option value="{country068}">{country068}</option>
					<option value="{country069}">{country069}</option>
					<option value="{country070}">{country070}</option>
					<option value="{country071}">{country071}</option>
					<option value="{country072}">{country072}</option>
					<option value="{country073}">{country073}</option>
					<option value="{country074}">{country074}</option>
					<option value="{country075}">{country075}</option>
					<option value="{country076}">{country076}</option>
					<option value="{country077}">{country077}</option>
					<option value="{country078}">{country078}</option>
					<option value="{country079}">{country079}</option>
					<option value="{country080}">{country080}</option>
					<option value="{country081}">{country081}</option>
					<option value="{country082}">{country082}</option>
					<option value="{country083}">{country083}</option>
					<option value="{country084}">{country084}</option>
					<option value="{country085}">{country085}</option>
					<option value="{country086}">{country086}</option>
					<option value="{country087}">{country087}</option>
					<option value="{country088}">{country088}</option>
					<option value="{country089}">{country089}</option>
					<option value="{country090}">{country090}</option>
					<option value="{country091}">{country091}</option>
					<option value="{country092}">{country092}</option>
					<option value="{country093}">{country093}</option>
					<option value="{country094}">{country094}</option>
					<option value="{country095}">{country095}</option>
					<option value="{country096}">{country096}</option>
					<option value="{country097}">{country097}</option>
					<option value="{country098}">{country098}</option>
					<option value="{country099}">{country099}</option>
					<option value="{country100}">{country100}</option>
					<option value="{country101}">{country101}</option>
					<option value="{country102}">{country102}</option>
					<option value="{country103}">{country103}</option>
					<option value="{country104}">{country104}</option>
					<option value="{country105}">{country105}</option>
					<option value="{country106}">{country106}</option>
					<option value="{country107}">{country107}</option>
					<option value="{country108}">{country108}</option>
					<option value="{country109}">{country109}</option>
					<option value="{country110}">{country110}</option>
					<option value="{country111}">{country111}</option>
					<option value="{country112}">{country112}</option>
					<option value="{country113}">{country113}</option>
					<option value="{country114}">{country114}</option>
					<option value="{country115}">{country115}</option>
					<option value="{country116}">{country116}</option>
					<option value="{country117}">{country117}</option>
					<option value="{country118}">{country118}</option>
					<option value="{country119}">{country119}</option>
					<option value="{country120}">{country120}</option>
					<option value="{country121}">{country121}</option>
					<option value="{country122}">{country122}</option>
					<option value="{country123}">{country123}</option>
					<option value="{country124}">{country124}</option>
					<option value="{country125}">{country125}</option>
					<option value="{country126}">{country126}</option>
					<option value="{country127}">{country127}</option>
					<option value="{country128}">{country128}</option>
					<option value="{country129}">{country129}</option>
					<option value="{country130}">{country130}</option>
					<option value="{country131}">{country131}</option>
					<option value="{country132}">{country132}</option>
					<option value="{country133}">{country133}</option>
					<option value="{country134}">{country134}</option>
					<option value="{country135}">{country135}</option>
					<option value="{country136}">{country136}</option>
					<option value="{country137}">{country137}</option>
					<option value="{country138}">{country138}</option>
					<option value="{country139}">{country139}</option>
					<option value="{country140}">{country140}</option>
					<option value="{country141}">{country141}</option>
					<option value="{country142}">{country142}</option>
					<option value="{country143}">{country143}</option>
					<option value="{country144}">{country144}</option>
					<option value="{country145}">{country145}</option>
					<option value="{country146}">{country146}</option>
					<option value="{country147}">{country147}</option>
					<option value="{country148}">{country148}</option>
					<option value="{country149}">{country149}</option>
					<option value="{country150}">{country150}</option>
					<option value="{country151}">{country151}</option>
					<option value="{country152}">{country152}</option>
					<option value="{country153}">{country153}</option>
					<option value="{country154}">{country154}</option>
					<option value="{country155}">{country155}</option>
					<option value="{country156}">{country156}</option>
					<option value="{country157}">{country157}</option>
					<option value="{country158}">{country158}</option>
					<option value="{country159}">{country159}</option>
					<option value="{country160}">{country160}</option>
					<option value="{country161}">{country161}</option>
					<option value="{country162}">{country162}</option>
					<option value="{country163}">{country163}</option>
					<option value="{country164}">{country164}</option>
					<option value="{country165}">{country165}</option>
					<option value="{country166}">{country166}</option>
					<option value="{country167}">{country167}</option>
					<option value="{country168}">{country168}</option>
					<option value="{country169}">{country169}</option>
					<option value="{country170}">{country170}</option>
					<option value="{country171}">{country171}</option>
					<option value="{country172}">{country172}</option>
					<option value="{country173}">{country173}</option>
					<option value="{country174}">{country174}</option>
					<option value="{country175}">{country175}</option>
					<option value="{country176}">{country176}</option>
					<option value="{country177}">{country177}</option>
					<option value="{country178}">{country178}</option>
					<option value="{country179}">{country179}</option>
					<option value="{country180}">{country180}</option>
					<option value="{country181}">{country181}</option>
					<option value="{country182}">{country182}</option>
					<option value="{country183}">{country183}</option>
					<option value="{country184}">{country184}</option>
					<option value="{country185}">{country185}</option>
					<option value="{country186}">{country186}</option>
					<option value="{country187}">{country187}</option>
					<option value="{country188}">{country188}</option>
					<option value="{country189}">{country189}</option>
					<option value="{country190}">{country190}</option>
					<option value="{country191}">{country191}</option>
					<option value="{country192}">{country192}</option>
					<option value="{country193}">{country193}</option>
					<option value="{country194}">{country194}</option>
					<option value="{country195}">{country195}</option>
					<option value="{country196}">{country196}</option>
					<option value="{country197}">{country197}</option>
					<option value="{country198}">{country198}</option>
					<option value="{country199}">{country199}</option>
					<option value="{country200}">{country200}</option>
					<option value="{country201}">{country201}</option>
					<option value="{country202}">{country202}</option>
					<option value="{country203}">{country203}</option>
					<option value="{country204}">{country204}</option>
					<option value="{country205}">{country205}</option>
					<option value="{country206}">{country206}</option>
					<option value="{country207}">{country207}</option>
					<option value="{country208}">{country208}</option>
					<option value="{country209}">{country209}</option>
					<option value="{country210}">{country210}</option>
					<option value="{country211}">{country211}</option>
					<option value="{country212}">{country212}</option>
					<option value="{country213}">{country213}</option>
					<option value="{country214}">{country214}</option>
					<option value="{country215}">{country215}</option>
					<option value="{country216}">{country216}</option>
					<option value="{country217}">{country217}</option>
					<option value="{country218}">{country218}</option>
					<option value="{country219}">{country219}</option>
					<option value="{country220}">{country220}</option>
					<option value="{country221}">{country221}</option>
					<option value="{country222}">{country222}</option>
					<option value="{country223}">{country223}</option>
					<option value="{country224}">{country224}</option>
					<option value="{country225}">{country225}</option>
					<option value="{country226}">{country226}</option>
					<option value="{country227}">{country227}</option>
					<option value="{country228}">{country228}</option>
					<option value="{country229}">{country229}</option>
					<option value="{country230}">{country230}</option>
					<option value="{country231}">{country231}</option>
					<option value="{country232}">{country232}</option>
					<option value="{country233}">{country233}</option>
					<option value="{country234}">{country234}</option>
					<option value="{country235}">{country235}</option>
					<option value="{country236}">{country236}</option>
					<option value="{country237}">{country237}</option>
					<option value="{country238}">{country238}</option>
					<option value="{country239}">{country239}</option>
					<option value="{country240}">{country240}</option>
					<option value="{country241}">{country241}</option>
					<option value="{country242}">{country242}</option>
					<option value="{country243}">{country243}</option>
					<option value="{country244}">{country244}</option>
					<option value="{country245}">{country245}</option>
					<option value="{country246}">{country246}</option>
					<option value="{country247}">{country247}</option>
					<option value="{country248}">{country248}</option>
					<option value="{country249}">{country249}</option>
					<option value="{country250}">{country250}</option>
					<option value="{country251}">{country251}</option>
					<option value="{country252}">{country252}</option>
					<option value="{country253}">{country253}</option>
					<option value="{country254}">{country254}</option>
					<option value="{country256}">{country256}</option>
					<option value="{country257}">{country257}</option>
					<option value="{country258}">{country258}</option>
					<option value="{country259}">{country259}</option>
					<option value="{country260}">{country260}</option>
					<option value="{country261}">{country261}</option>
					<option value="{country262}">{country262}</option>
					<option value="{country263}">{country263}</option>
					<option value="{country264}">{country264}</option>
					<option value="{country265}">{country265}</option>
					<option value="{country266}">{country266}</option>
					<option value="{country267}">{country267}</option>
					<option value="{country268}">{country268}</option>
					<option value="{country269}">{country269}</option>
				</select>
				<br />
				<fieldset id="3D_printer_owner" data-role="controlgroup"
					data-type="horizontal">
					<legend>{3D_printer_owner}</legend>
					<input name="3D_printer_owner" id="3D_printer_owner_yes"
						value="yes" type="radio"> <label for="3D_printer_owner_yes">{yes}</label>
					<input name="3D_printer_owner" id="3D_printer_owner_no" value="no"
						type="radio"> <label for="3D_printer_owner_no">{no}</label>
				</fieldset>
				<div id="ThreeDprinterDiv">
					<select name="ThreeDprinter" id="ThreeDprinter"
						data-native-menu="false">
						<option value="{ThreeDprinter02}">{ThreeDprinter02}</option>
						<option value="{ThreeDprinter03}">{ThreeDprinter03}</option>
						<option value="{ThreeDprinter04}">{ThreeDprinter04}</option>
					</select>
					<div id="printer_makeDiv">
						<input type="text" id="printer_make" name="printer_make" value=""
							placeholder="{printer_make}">
					</div>	
				</div>
				<fieldset id="ever_use_3D_printer" data-role="controlgroup"
					data-type="horizontal">
					<legend>{ever_use}</legend>
					<input name="ever_use_3D_printer" id="ever_use_3D_printer_yes"
						value="yes" type="radio"> <label for="ever_use_3D_printer_yes">{yes}</label>
					<input name="ever_use_3D_printer" id="ever_use_3D_printer_no"
						value="no" type="radio"> <label for="ever_use_3D_printer_no">{no}</label>
				</fieldset>
				<select name="criteriaA" id="criteriaA" data-native-menu="false">
					<option value="choose-one" data-placeholder="true">{criteriaA}</option>
					<option value="{criteriaA01}">{criteriaA01}</option>
					<option value="{criteriaA02}">{criteriaA02}</option>
					<option value="{criteriaA03}">{criteriaA03}</option>
					<option value="{criteriaA04}">{criteriaA04}</option>
				</select>
				<div id="websiteURLDiv">
					<input type="text" id="websiteURL" name="websiteURL" value=""
						placeholder="{websiteURL}">
				</div>
				<select name="social_media" id="social_media"
					data-native-menu="false">
					<option value="choose-one" data-placeholder="true">{social_media}</option>
					<option value="{social_media01}">{social_media01}</option>
					<option value="{social_media02}">{social_media02}</option>
					<option value="{social_media03}">{social_media03}</option>
					<option value="{social_media04}">{social_media04}</option>
					<option value="{social_media05}">{social_media05}</option>
					<option value="{social_media06}">{social_media06}</option>
				</select>
				<div id="social_media_customDiv">
					<input type="text" name="social_media_custom" value=""
						placeholder="{social_media_custom}">
				</div>
				<input type="text" name="handle" value="" placeholder="{handle}">
				<div class="ui-grid-a">
					<div class="ui-block-a" style="width: 50px;">
						<input type="checkbox" name="tos" id="tos" data-mini="true">
					</div>
					<div class="ui-block-b">
						<a id="agree" href="/my_3d_print_with_zeepro/terms_of_service"
							data-ajax="false"
							style="font-weight: normal; color: #000; text-shadow: 0 1px 0 #fff"
							target="_blank">{terms_of_service_agreement}</a>
					</div>
				</div>
				<input type="submit" name="submit" value="<?php echo t('apply') ?>" data-theme="b" />
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("header.page-header").html('<a href="javascript:history.back();" data-role="button" data-theme="b" data-icon="back" data-ajax="false">{back}</a>')
	$("#ThreeDprinterDiv").hide();
	$("#printer_makeDiv").hide();
	$("#websiteURLDiv").hide();
	$("#social_media_customDiv").hide();
	$("#3D_printer_owner_yes").bind("click", function(event, ui) {
		$("#ThreeDprinterDiv").show("slow");
	});
	$("#3D_printer_owner_no").bind("click", function(event, ui) {
		$("#ThreeDprinterDiv").hide("slow");
	});
	$("#ThreeDprinter").change(function () {
		if($(this).val() == "{ThreeDprinter04}")
			$("#printer_makeDiv").show("slow");
		else {
			$("#printer_makeDiv").hide("slow");
		}
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
	$("#3D_printer_owner_yes").click(function() {
		$("#3D_printer_owner").css('color', '#000');
	});
	$("#3D_printer_owner_no").click(function() {
		$("#3D_printer_owner").css('color', '#000');
	});
	$("#printer_make").focusout(function() {
		if($(this).val() == '')
			$(this).parent().closest('div').css('border-color', '#f00')
		else
			$(this).parent().closest('div').css('border-color', '#ddd');
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
		if ($("input[type='radio'][name='3D_printer_owner']:checked").length == 0) {
			$("#3D_printer_owner").css('color', '#f00');
			hasError = true;
		} else if ($("input[type='radio'][name='3D_printer_owner']:checked").val() == "yes" && $("#ThreeDprinter").val() == '{{ThreeDprinter04}}' && $("#printer_make").val() == '') {
				$("#printer_make").parent().closest('div').css('border-color', '#f00');
				hasError = true;
		}
		if ($("input[type='radio'][name='ever_use_3D_printer']:checked").length == 0) {
			$("#ever_use_3D_printer").css('color', '#f00');
			hasError = true;
		}			
		if ($("#criteriaA").val() == 'choose-one') {
			$("#criteriaA-button").css('border-color', '#f00');
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

    $.mobile.filterable.prototype.options.children = "> li:not(:jqmData(placeholder='true')), > option, > optgroup option, > tbody tr, > .ui-controlgroup-controls > .ui-btn, > .ui-controlgroup-controls > .ui-checkbox, > .ui-controlgroup-controls > .ui-radio";
    
    $.mobile.document.on( "listviewcreate", "#country-menu", function( e ) {
	    var input,
	        listbox = $( "#country-listbox" ),
	        form = listbox.jqmData( "filter-form" ),
	        listview = $( e.target );
	    if ( !form ) {
	        input = $( "<input data-type='search'></input>" );
	        form = $( "<form></form>" ).append( input );
	        input.textinput();
	        $( "#country-listbox" )
	        .prepend( form )
	        .jqmData( "filter-form", form );
	    }
	    listview.filterable({ input: input });
	    $("#country-menu").css("margin-top", "20px");
	}).on( "pagebeforeshow pagehide", "#country-dialog", function( e ) {
	    var form = $( "#country-listbox" ).jqmData( "filter-form" ),
	        placeInDialog = ( e.type === "pagebeforeshow" ),
	        destination = placeInDialog ? $( e.target ).find( ".ui-content" ) : $( "#country-listbox" );
	    form
	    .find( "input" )
	    .textinput( "option", "inset", !placeInDialog )
	    .end()
	    .prependTo( destination );
	});	
</script>