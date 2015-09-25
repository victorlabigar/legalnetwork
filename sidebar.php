<?php
/**
 * The sidebar containing the main widget area
 *
 */ ?>


<div class="sidebar col-xs-12 col-md-4">
  <div class="row">
    
    <?php if( dynamic_sidebar('widget-area-category') ); ?>

    <?php include('partials/latestnews.php'); ?>

    <div class="col-sm-6 col-md-12">
   		<div class="content-block bg-blue">
   			<h3>Neem contact met ons op</h3>
        <br>
        <p>Gebouw Atrium<br>
        Strawinskylaan 3145 <br>
        1077 ZX Amsterdam <br>
        Nederland <br>
        Telefoon: 020 – 123 4567 <br>
        E-mail: info@legalnetwork.nl
        </p>
   		</div>
   	</div>

   	<!-- <div class="col-sm-6 col-md-12">
   		<div class="content-block bg-blue">
   			<h3>Waarom The Legal Company?</h3>
   			<a href="#">lees het hier</a>
   		</div>
   	</div> -->

  </div> <!-- end row -->
</div> <!-- end cols -->
