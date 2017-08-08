<% include SCEHeader ExtraClass=$ExtraHeaderClass %>
<% if $Images %>
	<% loop $Images %>
		<div class="describedimage">
			<% if $ImagePosition == 'top' %>
				<% include SCEProcessedImage Lightbox=$Up.Lightbox %>
			<% end_if %>
			<div class="sce__text">
				$Content
			</div>
			<% if $ImagePosition == 'bottom' %>
				<% include SCEProcessedImage Lightbox=$Up.Lightbox %>
			<% end_if %>
		</div>
	<% end_loop %>
<% end_if %>
<% include SCEFooter %>