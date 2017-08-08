<% include SCEHeader ExtraClass=$ExtraHeaderClass %>
<% if $Images %>
	<% loop $Images %>
		<div class="describedimage">
			<% include SCEProcessedImage Lightbox=$Up.Lightbox %>
			$Content
		</div>
	<% end_loop %>
<% end_if %>
<% include SCEFooter %>