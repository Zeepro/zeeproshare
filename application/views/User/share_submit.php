<style type="text/css">
	p { color: #000; text-shadow: 0 1px #FFF; }
	h2 { color: #000; text-shadow: 0 1px #FFF; }
</style>
<div class="content-wrapper">
	<div class="ui-grid-b ui-corner-all ui-shadow ui-transparent" style="padding: 5px;">
		<p>{msg_share_submit}</p>
		<a href="/user/v2" data-role="button" data-icon="home" data-theme="b">{home}</a>
	</div>

<script>
	$("header.page-header").html('<a href="javascript:history.back();" data-icon="back" data-theme="b">{back}</a> <a href="/user/v2" data-icon="home" data-theme="b">{home}</a>');
</script>
</div>