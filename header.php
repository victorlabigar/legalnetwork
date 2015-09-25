<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till the menu
 *
 * Author: StudioViq
 * Author URI: http://studioviq.nl/
 */ ?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html id="top" class="no-js no-touch sb-static" <?php language_attributes(); ?>> <!--<![endif]-->
	<head>
	    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

	    <title><?php legalnetwork_title(); ?></title>

	    <link rel="profile" href="http://gmpg.org/xfn/11" />
	    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-57x57.png" />
	    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-72x72.png" />
	    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-114x114.png" />
	    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-144x144.png" />
			
	    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />

			
	    <!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script><![endif]-->
		
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	    <![endif]-->

	    <?php wp_head(); ?>

	</head>
	
	
	<body <?php body_class(); ?>>
		<div id="sb-site">
			
			<!-- start header -->
			<header style="-webkit-transform: translate(0px);">
				<div class="container-fluid">
					
					<div class="inner-shell">
						<div class="row">
							<div class="header-wrap col-xs-10 col-sm-9">
								<ul class="logo-wrap">
								 	<li><a href="<?php echo home_url(); ?>" class="logo"></a></li><!--
									--><li class="tagline">
								 		<p class="site-payoff">the new generation law </p>
								 		<!-- <p class="site-counter">1300 advocaten</p> --></li>
								</ul>
							</div>

							<div class="call-us col-xs-12 col-sm-3 pull-right">
								<div class="wrap-phone">
								<p class="call-title">Bel ons op</p>
								<p class="call-number">020 - 123 4567</p>
								</div>
							</div>
							
							<div class="hamburger-wrap col-xs-2">
								<div class="sb-toggle-right navbar-right">
				          <div class="navicon-line"></div>
				          <div class="navicon-line"></div>
				          <div class="navicon-line"></div>
				        </div>
							</div>

						</div>  <!-- end row -->
					</div> <!-- end inner-shell -->

					
					<div id="desktop-menu" class="row">
						<nav role="navigation" class="col-xs-12 col-sm-12 col-md-12">
							<div class="inner-shell">
								<div class="row">
									<?php legalnetwork_main_menu(); ?>
								</div>
							</div>
						</nav>	
					</div> <!-- end row -->

				</div> <!-- end container-fluid -->
				
			</header> <!-- end header -->