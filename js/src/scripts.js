// make map variable available in globalscope - console log only has acces to global scope variables
var map;

// Google Maps
function drawMap() {
  "use strict";
  var myLatlng = new google.maps.LatLng(52.3396862,4.869929);
  
  //{ lat: 52.3396862, lng: 4.869929};
  var mapOptions = {
    center: myLatlng,
    zoom: 15,
    streetViewControl: false,
    scrollwheel: false,
    draggable: true
  };

  map = new google.maps.Map(document.getElementById('myMap'), mapOptions);

  var contentString = '<div id="mapWindow">'+
      '<h2 id="firstHeading" class="firstHeading">Hier zijn wij te vinden!</h2>'+
      '<div id="bodyContent">'+
      '<p><b>Legal Network</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
      'sandstone rock formation in the southern part of the '+
      'Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) '+
      'Heritage Site.</p>'+
      '</div>'+
      '</div>';

  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Legal Network'
  });

  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });
}

document.addEventListener('DOMContentLoaded', drawMap);


// FLEXSLIDER - declaration
$(window).load(function() {
  var $flexslider = $(".flexslider");
  $flexslider.flexslider({
    animation: "slide",
    controlNav: true,
    directionNav: false,
    manualControls: " ",
    useCSS: false,
    slideshow: true
  });
});


$(document).ready(function(){
  //$('.element').responsiveEqualHeightGrid();
  $.slidebars({
    siteClose: true, // true or false
    //disableOver: 480, // integer or false
    //hideControlClasses: true, // true or false
    scrollLock: false // true or false
  });

  $('.sb-slidebar .main-menu a').off('click').on('click', function() {
      $submenu = $(this).parent().children('.sub-menu');
      $(this).add($submenu).toggleClass('sub-menu-active'); // Toggle active class.

      if ($submenu.hasClass('sub-menu-active')) {
          $submenu.slideDown(200);
      } else {
          $submenu.slideUp(200);
      }
  });

  $("#menu-main-menu li").mouseover(function() {
    var the_width = $(this).find("a").width();
    var child_width = $(this).find("ul").width();
    var width = parseInt((child_width - the_width)/2, 9);
    $(this).find("ul").css('left', - width + 5);
  });

});