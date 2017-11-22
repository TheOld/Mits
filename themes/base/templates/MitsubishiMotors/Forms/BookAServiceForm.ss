<% if $IncludeFormTag %>
	<form $AttributesHTML>
<% end_if %>
<% if $Message %>
		<p id="{$FormName}_error" class="message $MessageType">$Message</p>
<% else %>
		<p id="{$FormName}_error" class="message $MessageType" style="display: none"></p>
<% end_if %>

	<h4 class="my--5x">Personal informations</h4>
	<p class="mb--6x">All fields with a<i class="form-symbol-required"></i>are required.</p>

	<fieldset>
		$Fields.dataFieldByName('FirstName').FieldHolder
	</fieldset>

	<fieldset>
		$Fields.dataFieldByName('LastName').FieldHolder
	</fieldset>

	<fieldset>
		$Fields.dataFieldByName('Email').FieldHolder
	</fieldset>

	<fieldset>
		$Fields.dataFieldByName('Phone').FieldHolder
	</fieldset>

	<fieldset>
		$Fields.dataFieldByName('Location').FieldHolder
		$Fields.dataFieldByName('Address1').FieldHolder
		$Fields.dataFieldByName('Address2').FieldHolder
		$Fields.dataFieldByName('Suburb').FieldHolder
		$Fields.dataFieldByName('City').FieldHolder
	</fieldset>

	<fieldset>
		$Fields.dataFieldByName('PreferredDealer').FieldHolder
	</fieldset>

	<h4 class="my--5x">Booking details</h4>

	<fieldset>
		$Fields.dataFieldByName('PreferredDropOff').FieldHolder
	</fieldset>

	<fieldset>
		$Fields.dataFieldByName('PreferredPickUp').FieldHolder
	</fieldset>

	<fieldset>
		$Fields.dataFieldByName('RegistrationPlate').FieldHolder
	</fieldset>

	<fieldset>
		$Fields.dataFieldByName('ServiceType').FieldHolder
	</fieldset>

	<fieldset>
		$Fields.dataFieldByName('OtherServiceType').FieldHolder
		$Fields.dataFieldByName('SecurityID')
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


