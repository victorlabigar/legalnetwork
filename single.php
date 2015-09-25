<?php get_header(); ?>

<?php include('partials/top-banner.php'); ?>

<div class="container-fluid single-page">
	<div class="inner-shell">
		<div class="row">


			<div class="main-content">
				<div class="container-fluid">
          <div class="row">
               
         		<div class="inner-shell">
							<?php get_template_part('content', 'page') ?>
							<?php get_sidebar(); ?>
         		</div> <!-- end inner-shell -->

          </div> <!-- end row -->
        </div> <!-- end container-fluid -->
			</div> <!-- end main-content -->


		</div> <!-- end row -->
	</div> <!-- end container -->
</div>	<!-- end container-fluid -->

<?php get_footer(); ?>