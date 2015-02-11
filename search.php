<?php get_header(); ?>

	<div class="large-wrap">
		
		<div class="layout 1/1" role="main">
							
			<div class="layout__item 1/3">
								
				<?php get_sidebar(); ?>

			</div><!--
			Need the html comment for inline block not to break grid
			--><div class="layout__item 2/3">
					
					<?php if (have_posts()) : ?>

						<header class="page-header">
							<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'aphid' ), get_search_query() ); ?></h1>
						</header><!-- .page-header -->

					<?php while (have_posts()) : the_post();
							
							get_template_part( 'content', 'search');

					endwhile;
					
					else : 

						get_template_part( 'content', 'none' );

					endif; 
				?>

			</div> <!-- // layout__item(s) -->

		</div> <!-- // layout one-whole -->

	</div> <!-- // large-wrap -->

<?php get_footer(); ?>