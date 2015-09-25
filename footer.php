
			<footer>
				<div class="container-fluid">
					<div class="row footer-top">
						<div class="inner-shell">
							
							<?php if( dynamic_sidebar('widget-area-one') ); ?>
            	<?php if( dynamic_sidebar('widget-area-two') ); ?>
							<?php if( dynamic_sidebar('widget-area-three') ); ?>
							<?php if( dynamic_sidebar('widget-area-four') ); ?>

						</div> <!-- end inner-shell -->
					</div> <!-- end row -->

					<div class="row footer-bottom">
						<div class="inner-shell">
								<div class="col-xs-12 col-sm-8"><p>Legal Network - Privacy - Disclaimer - Algemene voorwaarden</p></div>
								<div class="col-xs-12 col-sm-4 text-right"><p>Realisatie door Studioviq</p></div>
						</div>
					</div>
				</div> <!-- end container-fluid -->
				
			</footer>
		</div> <!-- end #sb-site -->

		<div class="sb-slidebar sb-right" data-sb-width="15%">
		  <!-- Your right Slidebar content. -->
		  <h3>Maak uw keuze</h3>
			<!-- <hr> -->
			<?php legalnetwork_main_menu(); ?>
			
		</div>


		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			
			var _gaq = _gaq || [];
			var pluginUrl = '//www.google-analytics.com/plugins/ga/inpage_linkid.js';
			_gaq.push(['_require', 'inpage_linkid', pluginUrl]);
			
		  ga('create', 'UA-56952151-1', 'auto');
		  ga('require', 'displayfeatures');
		  ga('require', 'linkid', 'linkid.js');
		  ga('send', 'pageview');
		
		</script>
		
		<?php wp_footer(); ?>
  </body>
</html>