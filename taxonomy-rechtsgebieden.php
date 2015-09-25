<?php get_header(); ?>

<?php //include('partials/top-banner.php'); ?>

<?php
//$addname = get_field('banner_intro_cat', 'category_'. the_category_ID( $echo ).''); echo $addname;
// load all 'category' terms for the post
$terms = get_the_terms( get_the_ID(), 'rechtsgebieden');

// we will use the first term to load ACF data from
if( !empty($terms) ) {
  
  $term = array_pop($terms);

  $image_field = get_field('banner_image_cat', $term );
  $size = 'single_banner';
  $image = wp_get_attachment_image_src($image_field, $size );
}
?>

<?php //if( ( $category_image = category_image_src( array('size' =>  'single_banner' )  , false ) ) != null ): ?>
<div class="container-fluid" style="background:url(<?php echo $image[0]; ?>) no-repeat top center; background-size:cover;)">
<?php //endif; ?>
  <div class="inner-shell">
    <div class="row">
      
      <div class="top-content single-banner col-xs-12">
        <?php //if(have_posts()) : while ( have_posts() ) : the_post(); ?>
        <div class="col-xs-12">
          <h1><?php the_field('banner_titel_cat', $term); ?></h1>
        </div>
        <div class="col-xs-12">
          <p><?php the_field('banner_intro_cat', $term); ?></p>
        </div>
        <?php //endwhile; endif; ?>  
      </div> <!-- end .top-content .single-banner -->

    </div> <!-- end row -->
  </div> <!-- end container -->
</div>  <!-- end container-fluid -->


<div class="container-fluid single-page">
	<div class="inner-shell">
		<div class="row">


			<div class="main-content">
				<div class="container-fluid">
          <div class="row">
               
            <div class="inner-shell">
                 	
              <!-- Rechtsgebieden category overview -->
              <article id="post-<?php the_ID(); ?>" class="col-xs-12 col-md-8">
                
                <div class="entry-content">
                  
                    <div class="content-block single-content">
                      <h2><?php single_cat_title( '', true ); ?></h2>
                      <hr>
                      <?php echo category_description(); ?>

                      <div class="row">


                      <?php 
                        // $args = array(
                        //   'post_type' => array('post', 'rechtsgebieden'),
                        //   'posts_per_page' => -1
                        // );
                        // $officequery = new WP_Query($args);

                        // if($officequery->have_posts()) : while ( $officequery->have_posts() ) : $officequery->the_post(); 

                        if(have_posts()) : while ( have_posts() ) : the_post(); ?>

                        <div class="col-xs-12 col-sm-6 officeblock">
                          <div>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p class="customp person"><a href="<?php the_permalink(); ?>"><?php echo get_custom_value(naam_persoon); ?></a></p>
                            <p class="customp location"><?php echo get_custom_value(locatie); ?></p>
                            <?php echo improved_trim_excerpt(); ?>
                          </div>
                        </div>    
                      <?php endwhile; endif; ?>
                      </div>
                      

                    </div>
                  
                </div>
              </article>   	
                 	
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