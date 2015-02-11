<!doctype html>
<html class="no-js full-bg" lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php wp_title(''); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
				
		<!-- Stylesheet and Modernizer -->		
		<?php wp_head(); ?>

  </head>
	<body <?php body_class(); ?>>
	
		<div class="page-wrap">

			<header class="header large-wrap cf" role="banner">

					<!-- to use a image just replace the bloginfo('name') with an image -->
					<a class="site-logo" href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a>
					
					<button class="js--toggle-nav mobile-nav--toggle">
						<span></span>
						<span></span>
						<span></span>
					</button>

					<nav class="main-nav--toggle" role="navigation">
						<?php main_nav(); ?>
					</nav>

			</header> <!-- end header -->
