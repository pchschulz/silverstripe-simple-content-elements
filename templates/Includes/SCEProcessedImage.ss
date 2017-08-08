<div class="sce__image">
	<% if $Lightbox %>
		<a href="$Image.FitMax(1280,1024).Url" data-lightbox="lightbox">
		<i class="fa fa-search-plus"></i>
	<% end_if %>
	$ProcessedImage
	<% if $Lightbox %>
		</a>
	<% end_if %>
</div>