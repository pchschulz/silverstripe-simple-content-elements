<div class="sce__image">
	<% if $LightboxOrLink %>
		<% if $LightboxOrLink == 'lightbox'%>
			<a href="$Image.FitMax(1280,1024).Url" data-lightbox="lightbox">
		<% else %>
			<% if $Link %>
				<a class="image__link" href="$Link.Url" <% if $Link.Linkmode == 'URL' %>target="_blank"<% end_if %> title="$Link.Title">
			<% end_if %>
		<% end_if %>
	<% end_if %>
	$ProcessedImage
	<% if $LightboxOrLink %>
		<% if $LightboxOrLink == 'lightbox'%>
			</a>
		<% else %>
			<% if $Link %>
				</a>
			<% end_if %>
		<% end_if %>
	<% end_if %>
</div>