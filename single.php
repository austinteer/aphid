<?php 
/**
* The template for displaying all single posts and attachments
*/
?>
<?php get_header(); ?>

	<div class="large-wrap">
		<div class="layout 1/1">

			<div class="layout__item 1/3">
								
				<?php get_sidebar(); ?>

			</div><!--
			--><div class="layout__item 2/3" role="main">

			<?php 
				while ( have_posts() ) : the_post();
					
					get_template_part( 'content', get_post_format() );

					// Previous/next post navigation.
					the_post_navigation( array(
						'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next Post', 'aphid' ) . '</span> ' .
							'<span class="post-title">%title</span>',
						'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous Post ', 'aphid' ) . '</span> ' .
							'<span class="post-title">%title</span>',
					) );
				endwhile;
			?>

			</div> <!-- // layout__item(s) -->

		</div> <!-- // layout 1/1 -->

	</div> <!-- // large-wrap -->

<?php get_footer(); ?>