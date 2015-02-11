<?php 
/**
	* The main template file
	*/
?>
<?php get_header(); ?>
	<div class="large-wrap">
		<div class="layout 1/1">

			<div class="layout__item 1/3">
								
				<?php get_sidebar(); ?>

			</div><!--
			--><div class="layout__item 2/3" role="main">
			
			<?php if ( have_posts() ) : ?>

				<?php if ( is_home() && ! is_front_page() ) : ?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
				<?php endif; ?>
			
			<?php 
				while ( have_posts() ) : the_post();
					
					get_template_part( 'content', get_post_format() );

				endwhile;

				the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'aphid' ),
				'next_text'          => __( 'Next page', 'aphid' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'aphid' ) . ' </span>',
			) );

				else :

					get_template_part( 'content', 'none' );

				endif;
			?>

			</div> <!-- // layout__item(s) -->

		</div> <!-- // layout 1/1 -->

	</div> <!-- // large-wrap -->

<?php get_footer(); ?>