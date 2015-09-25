<?php 
	$args = array(
		'post_type' => 'onze_klanten', 
		'posts_per_page' => -1
	);
	$client_query = new WP_Query($args);
?>

<ul class="overview-list">
	<?php if($client_query->have_posts()) : while($client_query->have_posts()) : $client_query->the_post(); ?>
		<!-- the loop -->

		<li class="news-item">
			<div class="row">
				<div class="col-xs-12 col-sm-3">
					<?php the_post_thumbnail('logo_thumb');?>
				</div>
				<div class="col-xs-12 col-sm-9">
					<h2><a href="<?php get_custom_value(weblink); ?>" title="Bekijk de website <?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<?php the_content(); ?>
					<!-- <a class="weblink" href="<?php //get_custom_value(weblink); ?>">bekijk de website</a> -->
				</div>
			</div> <!-- end row -->
		</li> <!-- end li -->

	<?php endwhile; else: ?>
		<!-- nothing has been found -->
		<p>Er zijn helaas geen nieuwsberichten.</p>
	<?php endif; ?>
</ul> <!-- end .overview-list -->