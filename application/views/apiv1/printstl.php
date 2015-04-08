<div class="content-wrapper">
	<h2><?= t("titre") ?></h2>
	<div class="ui-grid-b ui-corner-all ui-shadow ui-transparent" style="padding: 5px; padding-bottom: 25px; color: #000;  text-shadow: 0 1px 0 #fff">
		<div class="ui-grid-a">
		    <div class="ui-block-a"><div class="ui-bar ui-bar-a"><?= t("service") ?></div></div>
    		<div class="ui-block-b"><div class="ui-bar ui-bar-a"><?= t("application") ?></div></div>
		</div>
		<br/>
		<?= t("descrition") ?>
		<br/>
		
		<form method="POST" enctype="multipart/form-data" data-ajax="false">
			<br/>
			<label for="file"><?= t("stl") ?></label>
			<input type="file" name="stl" id="stl" data-clear-btn="true" />
			<label for="id_partner"><?= t("id_partner") ?></label>
			<input type="text" name="id_partner" id="id_partner" value="" />
			<i><?= t("id_partner_info") ?></i>
			<fieldset data-role="controlgroup">
			    <legend><?= t("return_type") ?></legend>
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
			<br/>
			<?= t("note") ?>
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