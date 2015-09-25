<div class="col-sm-6 col-md-12">
	<div class="content-block bg-darkblue">
		<h2>Laatste nieuws</h2>
		<?php  
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => 1
			);

			$news_query = new WP_Query($args);

			if($news_query->have_posts()) : while($news_query->have_posts()) : $news_query->the_post();
		?>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<span class="date"><?php the_time( get_option( 'date_format' ) ); ?></span> 

		<?php endwhile; else: ?>
			<!-- nothing has been found -->
			<p>Er zijn helaas geen nieuwsberichten.</p>
		<?php endif; ?>
	</div>
</div>