<input $AttributesHTML <% include AriaAttributes %> />
<% if $Items %>
    <div class="entwine-placeholder">
        <% loop $Items %>
            <input type="hidden" name="$Up.Name[Files][]" value="$ID.ATT" />
        <% end_loop %>
    </div>
<% end_if %>
