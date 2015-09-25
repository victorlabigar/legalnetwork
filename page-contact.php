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
 * Template Name: Contact
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
             	
             	<?php while ( have_posts() ) : the_post(); ?>
								
								<article id="post-<?php the_ID(); ?>" class="content-block single-content">
								 	<div class="col-xs-12">
								 		<?php the_title( '<h2>', '</h2>' ); ?>
								 		<hr>
								 	</div>
								 	
							  	<div class="col-xs-12 col-sm-6">
										<?php the_content(); ?>
									</div>
								 		

								 	<div class="col-xs-12 col-sm-6 contactForm">
								 		<?php echo do_shortcode('[contact-form-7 id="56" title="Contactformulier"]' ); ?>
								 	</div>
								</article>

							<?php endwhile; ?>

							<?php //get_sidebar(); ?>
             	
         		</div> <!-- end inner-shell -->

          </div> <!-- end row -->
        </div> <!-- end container-fluid -->
			</div> <!-- end main-content -->


			<?php // if( dynamic_sidebar('widget-area-one') ); ?>

		</div> <!-- end row -->
	</div> <!-- end container -->
</div>	<!-- end container-fluid -->

<?php get_footer(); ?>