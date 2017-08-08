<% include SCEHeader %>
<% if $ImagePosition == 'left' %>
	<% include SCEProcessedImage %>
<% end_if %>
<div class="sce__text">
	$Content
</div>
<% if $ImagePosition == 'right' %>
	<% include SCEProcessedImage %>
<% end_if %>
<% include SCEFooter %>