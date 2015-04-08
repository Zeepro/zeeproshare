<?php
$template_data = array(
		'rendering_pagetitle'	=> t('rendering_pagetitle'),
		'reset_model_button'	=> t('reset_model_button'),
		'request_button'		=> t('request_button'),
		'back'					=> t('back'),
		'msg_webgl_failed'		=> t('msg_webgl_failed'),
		'msg_fetch_failed'		=> t('msg_fetch_failed'),
		'rendering_stl_url'		=> '/xxx/yyy.stl',	// normally, ajax call should be in the same domain
);
?>
<!-- client rendering part js -->
<script type="text/javascript" src="/assets/rendering/ivmatrix3d.js"></script>
<script type="text/javascript" src="/assets/rendering/ivwindow3d.js"></script>
<script type="text/javascript" src="/assets/rendering/ivspace3d.js"></script>
<script type="text/javascript" src="/assets/rendering/ivmtl3d.js"></script>
<script type="text/javascript" src="/assets/rendering/ivmesh3d.js"></script>
<script type="text/javascript" src="/assets/rendering/ivnode3d.js"></script>
<script type="text/javascript" src="/assets/rendering/ivextra.js"></script>
<script type="text/javascript" src="/assets/rendering/stl.js"></script>
<script type="text/javascript" src="/assets/rendering/zpviewer.js"></script>
<style> .zeeprocanvas { background-color: rgba(0,0,0,1.0); border: 0px; } </style>
<div class="content-wrapper">
	<h2>{rendering_pagetitle}</h2>
	<div id="preview_zone" style="clear: both; text-align: center;">
		<div id="preview_image_zone"><canvas id="ivwindow3d" width="500px" height="500px" class="zeeprocanvas"></canvas></div>
	</div>
	<div id="detail_zone" style="clear: both; text-align: center; display: none;">
		<div id="model_coordinate_info" style="font-size: small;">
			X = <span id="model_xsize_info">0</span>mm x 
			Y = <span id="model_ysize_info">0</span>mm x 
			Z = <span id="model_zsize_info">0</span>mm
		</div>
		<div id="control_modify_group">
			<div id="control_modify_mini_group" style="display: none;">
				<div data-role="navbar" style="margin-bottom: 1em;">
					<ul>
						<li><a id="slicer_mini_size" href="#" onclick="javascript: onMiniSliderSwitched('s');" class="ui-btn-active">%</a></li>
						<li><a id="slicer_mini_rotate_x" href="#" onclick="javascript: onMiniSliderSwitched('x');">X</a></li>
						<li><a id="slicer_mini_rotate_y" href="#" onclick="javascript: onMiniSliderSwitched('y');">Y</a></li>
						<li><a id="slicer_mini_rotate_z" href="#" onclick="javascript: onMiniSliderSwitched('z');">Z</a></li>
					</ul>
					<input type="range" name="slicer_mini_control" id="slicer_mini_control" value="100" min="1" max="1000" oninput="onMiniSliderChanged(this.value);" onchange="onMiniSliderChanged(this.value);" />
					<input type="button" class="slicer_reset_model_button" value="{reset_model_button}">
				</div>
			</div>
			<div data-role="collapsible" data-collapsed="true" id="control_modify_sliders">
				<h4>scale_rotate_title</h4>
				<ul data-role="listview" data-inset="true">
					<li data-role="list-divider">scale_title</li> <!-- <label for="slicer_size"></label> -->
					<li>
						<input type="range" name="slicer_size" id="slicer_size" value="100" min="1" max="1000" oninput="onSliderChanged('s', this.value);" onchange="onSliderChanged('s', this.value);" />
					</li>
					<li data-role="list-divider">rotate_title</li>
					<li>
						<label for="slicer_rotate_x">rotate_x_title</label>
						<input type="range" name="slicer_rotate_x" id="slicer_rotate_x" value="0" min="-180" max="180" oninput="onSliderChanged('x', this.value);" onchange="onSliderChanged('x', this.value);" />
						<label for="slicer_rotate_y">rotate_y_title</label>
						<input type="range" name="slicer_rotate_y" id="slicer_rotate_y" value="0" min="-180" max="180" oninput="onSliderChanged('y', this.value);" onchange="onSliderChanged('y', this.value);" />
						<label for="slicer_rotate_z">rotate_z_title</label>
						<input type="range" name="slicer_rotate_z" id="slicer_rotate_z" value="0" min="-180" max="180" oninput="onSliderChanged('z', this.value);" onchange="onSliderChanged('z', this.value);" />
					</li>
				</ul>
				<input type="button" class="slicer_reset_model_button" value="{reset_model_button}">
			</div>
		</div>
		<a href="#" id="request_button" class="ui-disabled" data-role="button">{request_button}</a>
	</div>
</div>

<script>
var var_multi_part = false;
var var_wait_preview = false;
var var_webgl_support = true;
var var_webgl_initialized = false;
var var_mini_control_slider_type = 's'; // scale as default
// back button
$("header.page-header").html('<a href="javascript:history.back();" data-role="button" data-theme="b" data-icon="back" data-ajax="false">{back}</a>');

// main body
$(document).ready(function() {
	getPreview();
	
	$("input.slicer_reset_model_button").click(function() {
		resetModel();
	});
});

function updateModelScale() {
// 	setInitialScale(view3d);
	var scale_toSet = Math.floor(view3d.transform_C.scale);
// 	onSliderChanged('s', scale_toSet);
	$("input#slicer_mini_control").val(scale_toSet);
	
	return;
}

function onWebGL_finalized() {
	$("div#detail_zone").show();
	$("a#request_button").removeClass("ui-disabled");
	
// 	onSliderChanged('s', 100);
	onSliderChanged('x', 0);
	onSliderChanged('y', 0);
	onSliderChanged('z', 0);
	updateModelScale();
	
	if (var_mini_control_slider_type == 's') {
		$("input#slicer_mini_control").attr("max", $("input#slicer_size").attr("max"));
		$("input#slicer_mini_control").slider("refresh");
	}
	
	return;
}

function onWebGLRequest_rollback() {
	var_webgl_initialized = true;
	var_webgl_support = false;
	$("div#preview_zone").html("{msg_fetch_failed}");
	
	return;
}

function onMiniSliderSwitched(type) {
	if (typeof(type) == 'undefined') return;
	
	var var_minToChange = null;
	var var_maxToChange = null;
	var var_valToChange = null;
	var var_typeToChange = null;
	
	switch (type) {
		case 's':
			var_minToChange = 1;
			var_maxToChange = $("input#slicer_size").attr("max");
			var_valToChange = $("input#slicer_size").val();
			var_typeToChange = 's';
			break;
			
		case 'x':
			var_typeToChange = 'x';
			var_valToChange = $("input#slicer_rotate_x").val();
		case 'y':
			if (var_typeToChange == null) var_typeToChange = 'y';
			if (var_valToChange == null) var_valToChange = $("input#slicer_rotate_y").val();
		case 'z':
			if (var_typeToChange == null) var_typeToChange = 'z';
			if (var_valToChange == null) var_valToChange = $("input#slicer_rotate_z").val();
			var_minToChange = -180;
			var_maxToChange = 180;
			break;
			
		default:
			return;
			break;
	}
	
	$("input#slicer_mini_control").attr("max", var_maxToChange);
	$("input#slicer_mini_control").attr("min", var_minToChange);
	$("input#slicer_mini_control").val(var_valToChange);
	var_mini_control_slider_type = var_typeToChange;
	$("input#slicer_mini_control").slider("refresh");
	
	return;
}

function onMiniSliderChanged(value) {
	switch (var_mini_control_slider_type) {
		case 's':
			$("input#slicer_size").val(value);
			$("input#slicer_size").slider("refresh");
			break;
			
		case 'x':
		case 'y':
		case 'z':
			$("input#slicer_rotate_" + var_mini_control_slider_type).val(value);
			$("input#slicer_rotate_" + var_mini_control_slider_type).slider("refresh");
			break;
			
		default:
			break;
	}
	
	return;
}

function getPreview(exchange) {
	// try client rendering firstly
	if (var_webgl_initialized == false) {
		zpInit3d(document.getElementById('ivwindow3d'), '{rendering_stl_url}');
		var_webgl_initialized = true;
	}
	if (var_webgl_support == true) {
		$("div#control_modify_sliders").hide();
		$("div#control_modify_mini_group").show();
	}
	else {
		console.log('WebGL initialization failed, stop in online mode');
		$("#preview_image_zone").html("{msg_webgl_failed}");
	}
	
	return;
}

function resetModel() {
	if (var_webgl_support == true) {
		view3d.cm_reset();
		onMiniSliderSwitched(var_mini_control_slider_type);
	}
	else {
		console.log('Online mode only support webgl case');
	}
	
	return;
}
</script>