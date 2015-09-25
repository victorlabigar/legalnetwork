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
 * Template Name: HomePage
 *	
 *	
 */ get_header(); ?>

<?php //while ( have_posts() ) : the_post(); ?>
<?php //get_template_part('content', 'page') ?>
<?php //endwhile; ?>
<?php //get_template_part('loop', 'portfolio') ?>
<?php // if( dynamic_sidebar('widget-area-one') ); ?>



	<div id="background-full" class="container-fluid">
		<div class="inner-shell">
			<div class="row">


			<script>
				$(document).ready(function(){
					$("#background-full").backstretch([
				    <?php 
							$images = CFS()->get('homepage_background_loop');
							foreach ($images as $image) {
							  echo "'{$image['background_image_full']}', ";
							}
						?>
				  ], {duration: 3000, fade: 750});

				});
			</script>
				
				<?php while(have_posts()) : the_post(); ?>
				<div class="top-content col-xs-12">
					<div class="">
						<div class="col-xs-12 col-sm-8">
							<!-- <h1>For some awesome advice on any legal matter, come to us.</h1> -->
							<h1><?php get_custom_value(heading_title); ?></h1>
							<p class="subtitle"><?php get_custom_value(heading_subtitle); ?></p>
						</div>
						<div class="col-xs-12 col-sm-4">
							<a href="<?php get_custom_value(button_url); ?>" class="button btn-blue"><?php get_custom_value(button_value); ?></a>
						</div>	
					</div>
				</div> <!-- end top-content -->

				<?php
					endwhile;
				?>
				

				<div class="main-content">
					<div class="container-fluid">
	          <div class="inner-shell">
                 
           		<div class="row">
             		<div class="col-sm-6 col-md-4 element">
                 	<div class="row">
                    
										
                    <?php if( dynamic_sidebar('widget-blue-home-block') ); ?>


                    <div class="col-md-12">
                    	<div class="content-block referenties bg-darkblue">
												<h2>Referenties</h2>
													
													
													<div class="flexslider">
														<ul class="slides">
															<?php 
																$args = array( 'post_type' => 'Referenties_slider' );
																$loop = new WP_Query( $args );

																while ($loop->have_posts() ) : $loop->the_post(); 
															?>
															

															<?php 
																$fields = CFS()->get('referentie');
																foreach ($fields as $field) {
																  echo "<li>";
																  echo '<div class="ref-item">';
																  echo "<p>{$field['beschrijving']}</p>";
																  echo '<div class="signature">';
																  echo "<h3>{$field['naam']}</h3>";
																  echo "<p>{$field['naam_kantoor']}</p>";
																  echo "</div>";
																  echo "</div></li>";
																}
															?>
															<?php endwhile; ?>
															
														</ul>
													</div> 
												</div>

                    </div>
                 	</div>
             		</div>
              
              	
               	
									
								<?php if( dynamic_sidebar('widget-area-home-categories') ); ?>
										
									

               	<div class="col-sm-12 col-md-4 ">
                  <div class="row">
                    
										<?php include('partials/latestnews.php'); ?>

                    

                    <div class="col-sm-6 col-md-12">
                   		<div class="content-block bg-darkblue">
                   			<h2>Neem contact met ons op</h2>
                   			<?php echo do_shortcode('[contact-form-7 id="41" title="Neem vrijblijvend contact op"]'); ?>
                   		</div>
                   	</div>
                  </div>
               	</div>
           		</div>

            </div> <!-- end inner-shell -->
          </div> <!-- end container-fluid -->
				</div> <!-- end main-content -->

			</div> <!-- end row -->
		</div> <!-- end container -->
	</div>	<!-- end container-fluid -->




<?php // if( dynamic_sidebar('widget-area-one') ); ?>


<?php get_footer(); ?>