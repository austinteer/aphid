<?php get_header(); ?>
<?php //  <div class="page-wrap">  This div closes on this page, but is opened in header.php ?>

	<div class="large-wrap">
		
		<div class="layout 1/1">
							
			<div class="layout__item 1/3">
								
				<?php get_sidebar(); ?>

			</div><!--

			--><div class="layout__item 2/3" role="main">

				<?php get_template_part( 'content', 'none' ); ?>

			</div> <!-- // layout__item(s) -->

		</div> <!-- // layout 1/1 -->

	</div> <!-- // large-wrap -->

</div>	<!-- // page-wrap -->

<?php get_footer(); ?>