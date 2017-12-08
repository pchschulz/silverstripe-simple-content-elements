<% include SCEHeader %>
<% if $Items %>
	<div class="accordion">
		<% loop $Items %>
			<div class="accordion__item">
				<div class="item__title cf">
					<span>
						$Title
					</span>
					<i class="fa fa-plus"></i>
				</div>
				<div class="item__content">
					<% if $Content %>
						<div class="content__text">$Content</div>
					<% end_if %>
					<% include SimpleContentElements %>
				</div>
			</div>
		<% end_loop %>
	</div>
<% end_if %>
<% include SCEFooter %>