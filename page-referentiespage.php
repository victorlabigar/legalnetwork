<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Author: StudioViq
 * Author URI: http://studioviq.nl/
 * 
 *
 * Template Name: Referenties Page
 *	
 *	
 */

 get_header(); ?>

<?php include('partials/top-banner.php'); ?>


<div class="container-fluid single-page">
	<div class="inner-shell">
		<div class="row">


			<div class="main-content">
				<div class="container-fluid">
          <div class="row">
               
         		<div class="inner-shell">

							<?php get_template_part('content', 'page'); ?>

							<?php get_sidebar(); ?>
             	
         		</div> <!-- end inner-shell -->

          </div> <!-- end row -->
        </div> <!-- end container-fluid -->
			</div> <!-- end main-content -->


			<?php // if( dynamic_sidebar('widget-area-one') ); ?>

		</div> <!-- end row -->
	</div> <!-- end container -->
</div>	<!-- end container-fluid -->

<?php get_footer(); ?>