<?php 
	$args = array(
		'post_type' => 'post', 
		'posts_per_page' => -1,
		'category_name' => 'nieuws'
	);
	$news_query = new WP_Query($args);
?>

<ul class="overview-list">
	<?php if($news_query->have_posts()) : while($news_query->have_posts()) : $news_query->the_post(); ?>
		<!-- the loop -->

		<li class="news-item">
			<div class="row">
				<div class="col-xs-12">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p class="date"><?php the_date(); ?></p>
				</div>
			</div> <!-- end row -->
		</li> <!-- end li -->

	<?php endwhile; else: ?>
		<!-- nothing has been found -->
		<p>Er zijn helaas geen nieuwsberichten.</p>
	<?php endif; ?>
</ul> <!-- end .overview-list -->