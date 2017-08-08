<% include SCEHeader ExtraClass=$ExtraHeaderClass %>
<% if $Images %>
	<% loop $Images %>
		<div class="describedimage">
			<% include SCEProcessedImage Lightbox=$Up.Lightbox %>
			<div class="sce__text">
				$Content
			</div>
		</div>
	<% end_loop %>
<% end_if %>
<% include SCEFooter %>