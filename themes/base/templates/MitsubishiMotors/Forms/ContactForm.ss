<% if $IncludeFormTag %>
<form $AttributesHTML>
	<% end_if %>
		<fieldset>
			<div class="grid--18">
				$Fields.dataFieldByName('Name').FieldHolder
			</div>
		</fieldset>
		<fieldset>
			<div class="grid--18">
				$Fields.dataFieldByName('Email').FieldHolder
			</div>
		</fieldset>
		<fieldset>
			<div class="grid--18">
				$Fields.dataFieldByName('Phone').FieldHolder
			</div>
		</fieldset>
		<fieldset>
			<div class="grid--18">
				$Fields.dataFieldByName('EnquiryType').FieldHolder
			</div>
		</fieldset>
		<fieldset>
			<div class="grid--18">
				$Fields.dataFieldByName('Message').FieldHolder
				$Fields.dataFieldByName('SecurityID')
			</div>
		</fieldset>
		<div class="mt--2x">
			$Fields.dataFieldByName('PageID')
			<% if $Actions %>
				<% loop $Actions %>
					$Field
				<% end_loop %>
			<% end_if %>
		</div>
<% if $IncludeFormTag %>
</form>
<% end_if %>
