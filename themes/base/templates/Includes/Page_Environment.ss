<% if isDev %>
	<script src="{$ThemeDir}/build/bundle-head.js"></script>
<% else %>
	<script>$addInlineScript('/build/bundle-head.js').RAW</script>
<% end_if %>

<% if isDev %>
	<link rel="stylesheet" href="{$ThemeDir}/build/bundle-style.css">
<% else %>
	<link rel="stylesheet" href="$HashPath('build/bundle-style.css')">
<% end_if %>
