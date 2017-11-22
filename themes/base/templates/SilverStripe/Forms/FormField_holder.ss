<div id="$HolderID" class="form__group <% if $Required %>form__group--required<% end_if %> field<% if $extraClass %> $extraClass<% end_if %>">
	<div class="form__input">
		$Field
		<% if $Title %><label class="left" for="$ID">$Title <i></i></label><% end_if %>
		<% if $Description %><span class="description">$Description</span><% end_if %>
	</div>
	<% if $Message %><span class="message $MessageType">$Message</span><% end_if %>
</div>
