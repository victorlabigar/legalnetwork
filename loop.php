<?php if(have_posts() ) : while(have_posts() ) : the_post(); ?>
	<?php the_title( '<h2>', '</h2>' ); ?>
	<hr>
	<?php the_content(); ?>
<?php  endwhile; else: ?>
	<!-- nothing has been found -->

	<h2>
		<?php _e('Niets gevonden', 'legalcompany'); ?>
	</h2>
	<hr>
	<p>
		<?php _e('Sorry, er is hier niets te vinden. Neem aub contact op voor meer informatie.', 'legalcompany'); ?>
	</p>

<?php endif; ?>