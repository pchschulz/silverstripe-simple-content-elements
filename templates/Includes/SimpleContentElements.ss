<% if $SimpleContentElements %>
	<article class="simple-content-elements">
		<% loop $SimpleContentElements %>
			$Layout
		<% end_loop %>
	</article>
<% end_if %>