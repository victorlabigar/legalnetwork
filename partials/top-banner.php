<?php
	$imageSize = 'single_banner';
?>

<?php if(is_page_template( 'page-contact.php' )) { ?>
	
	<div id="myMap" class="container-fluid"></div>	<!-- end container-fluid -->
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-tuPQkZSNV285QoFgcwn7jKbX93jONyo"></script>

<?php } else { ?>
	
	<div class="container-fluid" style="background:url(<?php if (has_post_thumbnail()) {$thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), $imageSize); echo $thumb[0];} ?>) no-repeat top center; background-size:cover;)">
		<div class="inner-shell">
			<div class="row">
				
				<div class="top-content single-banner col-xs-12">
					<div class="col-xs-12">
						<!-- <h1>For some awesome advice on any legal matter, come to us.</h1> -->
						<h1><?php echo get_custom_value(banner_title); ?></h1>
					</div>
					<div class="col-xs-12">
						<p><?php echo get_custom_value(banner_intro); ?></p>
						<?php //echo get_custom_value(banner_image); ?>
					</div>	
				</div> <!-- end .top-content .single-banner -->

			</div> <!-- end row -->
		</div> <!-- end container -->
	</div>	<!-- end container-fluid -->
	
<?php } ?>