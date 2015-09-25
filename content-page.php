<?php
/**
 * The template used for displaying page content
 *
 */
?>

<?php if(is_page('Referenties')) { ?>
	
	<article id="post-<?php the_ID(); ?>" class="col-xs-12 col-md-8" >
	 	<div class="content-block single-content">
		 	<?php while ( have_posts() ) : the_post(); ?>
				<?php the_title( '<h2>', '</h2>' ); ?>
				<hr>
				<?php the_content(); ?>
			<?php endwhile; ?>

			<?php 
	   		$args = array(
	 				'post_type' => 'Referenties',
	 				'posts_per_page' => -1
	 			);
	 			$ref_query = new WP_Query($args);
	   		while ( $ref_query->have_posts() ) : $ref_query->the_post(); 
	   	?>
		 	
			 	<div class="refblock col-xs-12 col-md-10">
			 		<?php the_title( '<h2 class="reftitle">', '</h2>' ); ?>
			 		<span><?php echo get_custom_value(company_name); ?></span>
			 		<hr>
			 		<?php the_content(); ?>
			 	</div>	
		 	
			<?php endwhile; ?>
		</div>
	</article>


<?php } elseif(is_page(6)) { ?>

	<!-- Rechtsgebieden -->
	<article id="post-<?php the_ID(); ?>" class="col-xs-12 col-md-8" >
	 	<div class="content-block single-content">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_title( '<h2>', '</h2>' ); ?>
				<hr>
				<?php the_content(); ?>
			<?php endwhile; ?>

			
			<div class="row">
			<!-- display customposts code -->
			<?php
				/*
				 * Loop through Categories and Display Posts within
				 */
				//$post_type = 'post';
				$post_type = 'advocaten';
				 
				// Get all the taxonomies for this post type
				$taxonomies = get_object_taxonomies( array( 'post_type' => $post_type ) );
				 
				foreach( $taxonomies as $taxonomy ) :
				 
				  // Gets every "category" (term) in this taxonomy to get the respective posts
				  $terms = get_terms( $taxonomy );

				  foreach( $terms as $term ) : ?>

					  <section class="expertises-section">

				      <div class="col-xs-12">
			          <h3><a href="<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></h3>
			          <hr>
				      </div>
							
							<ul class="overview-list col-xs-12">
				      <?php
					      $args = array(
		              'post_type' => $post_type,
		              'posts_per_page' => -1,  //show all posts
		              'exclude' => array(8,1),
		              'tax_query' => array(
	                  array(
	                    'taxonomy' => $taxonomy,
	                    'field' => 'slug',
	                    'terms' => $term->slug,
	                  )
		              )
					      );
				      	
				      	$posts = new WP_Query($args);

					      if( $posts->have_posts() ): while( $posts->have_posts() ) : $posts->the_post(); ?>

				          <li class="news-item">
										<div class="row">
											<div class="col-xs-12">
				                  <?php //if(has_post_thumbnail()) { ?>
				                          <?php //the_post_thumbnail(); ?>
				                  <?php // }
				                  /* no post image so show default */
				                  //else { ?>
				                         <!-- <img src="<?php //bloginfo('template_url'); ?>/assets/img/default-img.png" alt="<?php //echo get_the_title(); ?>" title="<?php //echo get_the_title(); ?>" width="110" height="110" /> -->
				                  <?php //} ?>
				                 

				                  <div class="inner-content">
					                  <h4><a href="<?php echo get_permalink(); ?>" title="Bekijk <?php echo get_the_title(); ?>"><?php  echo get_the_title(); ?></a></h4>
														<?php the_excerpt(); ?>
				                  </div>
				              </div><!-- about-box -->
				            </div>
									</li>

				      <?php endwhile; endif; ?>
				      </ul>
				      <div class="clearfix"></div>
				      
				    </section>

				  <?php endforeach;

				endforeach; ?>
				<!-- end custom posts code -->
			</div> <!-- end row -->

		</div>
	</article>

<?php } else { ?>


		<article id="post-<?php the_ID(); ?>" class="col-xs-12 col-md-8">
			<?php while ( have_posts() ) : the_post(); ?>
			<div class="entry-content">
			 	<div class="col-xs-12 col-sm-11">
			  	<div class="content-block single-content">
						<?php the_title( '<h2>', '</h2>' ); ?>
						<hr> 
						<?php the_content(); ?>
						
						<!-- nieuws overzichtpagina -->
						<?php if(is_page(10 )) { ?> 
							<?php get_template_part('loop', 'news'); ?>
						<?php } elseif(is_page(123)) { ?>
							<?php get_template_part('loop', 'klanten'); ?>
						<?php } else { ?>
						<!-- do nothing -->
						<?php } ?>

					</div>
			 	</div>	
			</div>
			<?php endwhile; ?>
		</article>

<?php } ?>