<div class="content-wrapper">
	<h2><?= t("titre") ?></h2>
	<div class="ui-grid-b ui-corner-all ui-shadow ui-opaque" style="padding: 5px; padding-bottom: 25px; color: #000;  text-shadow: 0 1px 0 #fff">
		<h3 style="text-align: center"><?= t("titre2") ?></h3>
		<div class="ui-grid-a">
		    <div class="ui-block-a"><div class="ui-bar ui-bar-a"><h4><?= t("service") ?></h4><br/><br/><?= t("service_description") ?></div></div>
    		<div class="ui-block-b"><div class="ui-bar ui-bar-a"><h4><?= t("application") ?></h4><br/><br/><?= t("application_description") ?></div></div>
		</div>
		<br/>
		<h3 style="text-align: center"><?= t("descrition") ?></h3>
		<?= t("note") ?>
		<form action="https://zeeproshare.com/api/print" method="POST" enctype="multipart/form-data" data-ajax="false">
			<label for="file"><h4><?= t("stl") ?></h4></label>
			<input type="file" name="stl" id="stl" data-clear-btn="true" />
			<label for="id_partner"><h4><?= t("id_partner") ?></h4></label>
			<input type="text" name="id_partner" id="id_partner" value="" />
			<i><?= t("id_partner_info") ?></i>
			<fieldset data-role="controlgroup">
			    <legend><h4><?= t("return_type") ?></h4></legend>
			        <input type="radio" name="return_type" id="return_type-1" value="plain_text" checked="checked" />
			        <label for="return_type-1"><?= t("plain_text") ?></label>
			        <input type="radio" name="return_type" id="return_type-2" value="json" />
			        <label for="return_type-2"><?= t("json") ?></label>
			        <input type="radio" name="return_type" id="return_type-3" value="xml" />
			        <label for="return_type-3"><?= t("xml") ?></label>
			        <input type="radio" name="return_type" id="return_type-4" value="html" />
			        <label for="return_type-4"><?= t("html") ?></label>
			</fieldset>
			<input type="submit" name="submit" value="<?= t("submit")?>" data-theme="b" onclick='javascript: uploadfile_wait();' />
		</form>
	</div>
	
	<script>
		function uploadfile_wait() {
			// this create a blocked spinner when we return to this page by back button
			$("#overlay").addClass("gray-overlay");
			$(".ui-loader").css("display", "block");
		}
	</script>
</div>