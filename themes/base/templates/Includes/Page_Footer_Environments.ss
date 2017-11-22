<% if isDev %>
	<script src="{$ThemeDir}/build/bundle-vendor.js"></script>
		<script src="{$ThemeDir}/build/bundle-index.js"></script>
<% else %>
	<script src="$HashPath('build/bundle-index.js')"></script>
<% end_if %>
<script>
	window.graphAuthToken = "{$graphAuthToken}"
</script>