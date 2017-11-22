<% if $IncludeFormTag %>
	<form $AttributesHTML>
<% end_if %>
<% if $Message %>
		<p id="{$FormName}_error" class="message $MessageType">$Message</p>
<% else %>
		<p id="{$FormName}_error" class="message $MessageType" style="display: none"></p>
<% end_if %>

	<h4 class="my--5x">Get in touch online</h4>
	<p class="mb--6x">All fields with a<i class="form-symbol-required"></i>are required.</p>

	<fieldset>
		$Fields.dataFieldByName('FullName').FieldHolder
	</fieldset>

	<fieldset>
		$Fields.dataFieldByName('Email').FieldHolder
	</fieldset>

	<fieldset>
		<div class="grid--9 grid__sm--18 grid__md--9">
			$Fields.dataFieldByName('Phone').FieldHolder
		</div>
		<br class="grid__sm--18 my--1x only-mobile" />
		<div class="grid--9 grid__sm--18 grid__md--9 grid--nogutters">
			$Fields.dataFieldByName('Location').FieldHolder
		</div>
	</fieldset>

	<fieldset>
		<div class="grid--9 grid__sm--18 grid__md--9 grid--nogutters">
			$Fields.dataFieldByName('ClosestDealer').FieldHolder
		</div>
	</fieldset>

	<hr class="gradient-border my--5x" />

	$Fields.dataFieldByName('SecurityID')

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
