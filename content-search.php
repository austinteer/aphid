<h3 class="search-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
<?php if(get_the_excerpt() ) : ?>
	<p><?php the_excerpt(); ?></p>
<?php endif; ?>