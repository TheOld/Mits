<% if $IncludeFormTag %>
<form $AttributesHTML>
	<% end_if %>
	<% if $Message %>
			<p id="{$FormName}_error" class="message $MessageType">$Message</p>
	<% else %>
			<p id="{$FormName}_error" class="message $MessageType" style="display: none"></p>
	<% end_if %>

		<h4 class="mb--4x">Your details</h4>
		<p class="mb--6x">All fields with a<i class="form-symbol-required"></i>are required.</p>

		<fieldset>
			<div class="grid--9 grid__sm--18 grid__md--9">
				$Fields.dataFieldByName('FirstName').FieldHolder
			</div>
			<br class="grid__sm--18 my--1x only-mobile" />
			<div class="grid--9 grid__sm--18 grid__md--9 grid--nogutters">
				$Fields.dataFieldByName('LastName').FieldHolder
			</div>
		</fieldset>
		<fieldset>
			<div class="grid--9 grid__sm--18 grid__md--9">
				$Fields.dataFieldByName('VIN').FieldHolder
			</div>
		</fieldset>
		<fieldset>
			<div class="grid--9 grid__sm--18 grid__md--9">
				$Fields.dataFieldByName('Email').FieldHolder
			</div>
		</fieldset>
		<fieldset>
			<div class="grid--9 grid__sm--18 grid__md--9">
				$Fields.dataFieldByName('Phone').FieldHolder
			</div>
		</fieldset>
		<fieldset>
			<div class="grid--18">
				$Fields.dataFieldByName('Details').FieldHolder
				$Fields.dataFieldByName('SecurityID')
			</div>
		</fieldset>
	<% if $Actions %>
		<div class="btn-toolbar mt--2x">
			<% loop $Actions %>
				$Field
			<% end_loop %>
		</div>
	<% end_if %>
<% if $IncludeFormTag %>
</form>
<% end_if %>
