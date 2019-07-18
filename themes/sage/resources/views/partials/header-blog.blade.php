	<div class="pt-3 pb-3 pink-bg">
		<div class="container">
			<div class="mb-3 row">
				<div class="col">
					<h1>{!! get_field('blog', 'options')['header'] !!}</h1>
				</div>
			</div>
			<div class="row">
				<nav class="navbar navbar-expand-md navbar-white w-100 categories" role="navigation">
					<div class="pl-3 container">
						<a class="navbar-brand d-block d-md-none" href="#">Категории</a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-category-navbar-collapse-1" aria-controls="bs-category-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
							<span>V</span>
						</button>
						@if(has_nav_menu('blog_navigation'))
						{!! wp_nav_menu([
						'theme_location' => 'blog_navigation',
						'depth' => 2,
						'container' => 'div',
						'container_class' => 'collapse navbar-collapse',
						'container_id' => 'bs-category-navbar-collapse-1',
						'menu_class' => 'nav navbar-nav',
						]) !!}
						@endif
					</div>
				</nav>
			</div>
		</div>
	</div>