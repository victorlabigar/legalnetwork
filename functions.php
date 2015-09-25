<?php
	add_action( 'after_setup_theme', 'legalnetwork_setup' );
	
	define( 'TEMPPATH' , get_bloginfo ('stylesheet_directory'));
	define( 'IMAGES', TEMPPATH. "/images");

/****************************************************************
   * REGISTER MENUS
****************************************************************/

function legalnetwork_setup(){
	// Add Menu Support
	add_theme_support('menus');
	load_theme_textdomain('legalnetwork_theme', get_template_directory() . '/languages');
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
  add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list',
  ) );

	add_image_size( 'single_banner', 1400, 250, true );
  add_image_size( 'logo_thumb', 150, 100, false );
}




// Change the fallback menu styling
// function add_menuid ($page_markup) {
// preg_match('/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $matches);
// $divclass = $matches[1];
// $toreplace = array('<div class="'.$divclass.'">', '</div>');
// $new_markup = str_replace($toreplace, '', $page_markup);
// $new_markup = preg_replace('/^<ul>/i', '<ul class="sidebar-nav">', $new_markup);
// return $new_markup; }




// Register labi Navigation
function register_legalnetwork_menu(){
  register_nav_menus(array( // Using array to specify more menus if needed
      'main-menu' => __('Main Menu', 'legalnetwork_theme'),
      'mobile-menu' => __('Mobile Menu', 'legalnetwork_theme')
  ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = ''){
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var){
    return is_array($var) ? array() : '';
}



/*------------------------------------*\
	Functions
\*------------------------------------*/

// labi navigation
function legalnetwork_main_menu(){
	wp_nav_menu(
		array(
			'theme_location'  => 'main-menu',
			'menu'            => '', 
			'container'       => 'div', 
			'container_class' => 'menu-{menu slug}-container', 
			'container_id'    => '',
			'menu_class'      => 'menu', 
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => '',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul class="main-menu">%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
		)
	);
}


function legalnetwork_mobile_menu(){
	wp_nav_menu(
		array(
			'theme_location'  => 'mobile-menu',
			'menu'            => '', 
			'container'       => 'div', 
			'container_class' => 'menu-{menu slug}-container', 
			'container_id'    => '',
			'menu_class'      => 'menu', 
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => '',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul class="list-unstyled">%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
		)
	);
}


/****************************************************************
   * WP-TITLE STANDARD (needed for the <title></title> tag)
****************************************************************/
function legalnetwork_title(){
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'legalnetwork_theme' ), max( $paged, $page ) );	
}



/****************************************************************
 * EXCERPT FUNCTION - limits the text
 ****************************************************************/

function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

function improved_trim_excerpt($text = '',$wordLimit = 25) { // Fakes an excerpt if needed
  if ( '' == $text ) {
    $text = get_the_content('');
  }

  $text = apply_filters('the_content', $text);
  $text = str_replace('\]\]\>', ']]&gt;', $text);
  $text = strip_tags($text, '<ol>,<h1>,<h2>,<h3>,<h4>,<ul>,<li>,<p>');
  $excerpt_length = $wordLimit;
  $words = explode(' ', $text, $excerpt_length + 1);

  if (count($words)> $excerpt_length) {
    array_pop($words);
    array_push($words, '[...]');
    $text = implode(' ', $words);
  }

  return $text;
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'improved_trim_excerpt');


/****************************************************************
   * KRIESI PAGINATION - creates a pagination
****************************************************************/
function kriesi_pagination($pages = '', $range = 2){
   $showitems = ($range * 2)+1;

   global $paged;
   if(empty($paged)) $paged = 1;

   if($pages == '')
   {
       global $wp_query;
       $pages = $wp_query->max_num_pages;
       if(!$pages)
       {
           $pages = 1;
       }
   }

   if(1 != $pages)
   {
       echo "<div class='pagination'><ul class='list-inline'>";
       if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'><i class='fa fa-angle-double-left'></i></a></li>";
       if($paged > 1 && $showitems < $pages) echo "<li class='spacing-right'><a href='".get_pagenum_link($paged - 1)."'><i class='fa fa-angle-left'></i></a></li>";

       for ($i=1; $i <= $pages; $i++)
       {
           if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
           {
               echo ($paged == $i)? "<li><a class='active'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class=\"btn-green\">".$i."</a></li>";
           }
       }

       if ($paged < $pages && $showitems < $pages) echo "<li class='spacing-left'><a href='".get_pagenum_link($paged + 1)."'><i class='fa fa-angle-right'></i></a></li>";
       if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'><i class='fa fa-angle-double-right'></i></a></li>";
       echo "</ul></div>\n";
   }
}

/****************************************************************
   * ADD CUSTOM POST TYPE - news post type
****************************************************************/
add_action( 'init', 'create_post_type' );

function create_post_type() {
  register_post_type( 'advocaten', 
    array(
      'labels' => array(
      'name' => __( 'Advocaten' ),
      'singular_name' => __( 'Advocaten' ),
      'add_new' => _x('Add New', 'Kantoor item'),
      'add_new_item' => __('Add New Kantoor Item'),
      'edit_item' => __('Edit Kantoor Item'),
      'new_item' => __('New Kantoor Item'),
      'view_item' => __('View Kantoor Item'),
      'search_items' => __('Search Kantoor Items'),
      'not_found' =>  __('Nothing found'),
      'not_found_in_trash' => __('Nothing found in Trash'),
      'parent_item_colon' => ''
      ),
    'public' => true,
    'has_archive' => false,
    'capability_type' => 'post',
    'hierarchical' => false,  
    'rewrite' => array( 'slug' => 'rechtsgebieden/%rechtsgebieden%','with_front' => false),
    //'rewrite' => true,  
    'supports' => array('title', 'editor', 'thumbnail','excerpt'),
    //'taxonomies' => array('category') // this is IMPORTANT
    )
  );

  register_post_type( 'Referenties',
		array(
			'labels' => array(
				'name' => __( 'Referenties' ),
				'singular_name' => __( 'Referenties' )
			),
		'public' => true,
		'has_archive' => false,
    'capability_type' => 'post',
    'hierarchical' => false,  
    'rewrite' => true,  
		'supports' => array( 'title', 'editor', 'author', 'thumbnail','comments', 'excerpt'),
		'taxonomies' => array('category', 'post_tag') // this is IMPORTANT
		)
	);

  register_post_type( 'Referenties_slider',
    array(
      'labels' => array(
        'name' => __( 'Referenties Slider' ),
        'singular_name' => __( 'Referenties_slider' )
      ),
    'public' => true,
    'has_archive' => true,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail','comments', 'excerpt'),
    'taxonomies' => array('category', 'post_tag') // this is IMPORTANT
    )
  );

  register_post_type( 'onze_klanten',
    array(
      'labels' => array(
        'name' => __( 'Onze klanten' ),
        'singular_name' => __( 'Klant' )
      ),
    'public' => true,
    'has_archive' => false,
    //'rewrite' => 'onze-klanten', 
    'supports' => array( 'title', 'editor','thumbnail'),
    //'taxonomies' => array('category', 'post_tag') // this is IMPORTANT
    )
  );
}


function create_taxonomy_expertise() {
  // create a new taxonomy
  register_taxonomy(
    'rechtsgebieden',
    'advocaten',
    array(
      'label' => __( 'Rechtsgebieden' ),
      'rewrite' => array( 'slug' => 'rechtsgebieden' ),
      '_builtin'    => false,
      'hierarchical' => true,
      'query_var'   => 'rechtsgebieden',
      'capabilities' => array(
          'manage__terms' => 'edit_posts',
          'edit_terms' => 'manage_categories',
          'delete_terms' => 'manage_categories',
          'assign_terms' => 'edit_posts'
      )
    )
  );
}
add_action( 'init', 'create_taxonomy_expertise', 0 );


// Permalink rechtsgebieden 
add_filter('post_link', 'brand_permalink', 1, 3);
add_filter('post_type_link', 'brand_permalink', 1, 3);

function brand_permalink($permalink, $post_id, $leavename) {
  //con %brand% catturo il rewrite del Custom Post Type
    if (strpos($permalink, '%rechtsgebieden%') === FALSE) return $permalink;
        // Get post
        $post = get_post($post_id);
        if (!$post) return $permalink;

        // Get taxonomy terms
        $terms = wp_get_object_terms($post->ID, 'rechtsgebieden');
        if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0]))
          $taxonomy_slug = $terms[0]->slug;
        else $taxonomy_slug = 'no-brand';

    return str_replace('%rechtsgebieden%', $taxonomy_slug, $permalink);
}



function wpse28145_add_custom_types( $query ) {
    if( is_tag() && $query->is_main_query() ) {

        // this gets all post types:
        //$post_types = get_post_types();

        // alternately, you can add just specific post types using this line instead of the above:
        $post_types = array( 'post', 'work' );

        $query->set( 'post_type', $post_types );
    }
}
add_filter( 'pre_get_posts', 'wpse28145_add_custom_types' );



/****************************************************************
   * CUSTOM FIELD SUITE - get_custom_value
****************************************************************/

function get_custom_value($key){
	echo CFS()->get($key);
}


/****************************************************************
   * REGISTER WIDGETS- news post type
****************************************************************/

require_once('classes'.DIRECTORY_SEPARATOR. 'widget-taxonomy-expertises.php');
require_once('classes'.DIRECTORY_SEPARATOR. 'widget-taxonomy-expertises-home.php');
require_once('classes'.DIRECTORY_SEPARATOR. 'widget-home-text-block.php');

function my_widgets_init() {   
	register_sidebar( array(
		'name' => 'Footer One',
		'id' => 'widget-area-one',
		'description' => __( 'Footer blok 1', 'legalnetwork_theme' ),
		'before_widget' => '<div class="col-xs-12 col-sm-3">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

  register_sidebar( array(
    'name' => 'Footer Two',
    'id' => 'widget-area-two',
    'description' => __( 'Footer blok 2', 'legalnetwork_theme' ),
    'before_widget' => '<div class="col-xs-12 col-sm-2">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ) );

  register_sidebar( array(
    'name' => 'Footer Three',
    'id' => 'widget-area-three',
    'description' => __( 'Footer blok 3', 'legalnetwork_theme' ),
    'before_widget' => '<div class="col-xs-12 col-sm-4"><div class="newsletter-wrap">',
    'after_widget' => '</div></div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ) );

  register_sidebar( array(
    'name' => 'Footer Four',
    'id' => 'widget-area-four',
    'description' => __( 'Footer blok 4', 'legalnetwork_theme' ),
    'before_widget' => '<div class="col-xs-12 col-sm-3">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ) );

    register_sidebar( array(
    'name' => 'Category Area',
    'id' => 'widget-area-category',
    'description' => __( 'Category Area', 'legalnetwork_theme' ),
    'before_widget' => ' <div class="col-sm-6 col-md-12"><div class="content-block bg-darkblue">',
    'after_widget' => '</div></div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
  ) ); 

	register_sidebar( array(
    'name' => 'Homepage Categories',
    'id' => 'widget-area-home-categories',
    'description' => __( 'Home Blok Categorieën', 'legalnetwork_theme' ),
    'before_widget' => ' ',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
  ) );

  register_sidebar( array(
    'name' => 'Homepage Blue Block',
    'id' => 'widget-blue-home-block',
    'description' => __( 'Home Blok Blue', 'legalnetwork_theme' ),
    'before_widget' => '<div class="col-md-12"><div class="content-block bg-blue">',
    'after_widget' => '</div></div>',
    'before_title' => '',
    'after_title' => '',
  ) );


	register_widget('Widget_Tax');
  register_widget('Widget_Tax_Home');
  register_widget('Widget_Blue_Home');
}

add_action( 'widgets_init', 'my_widgets_init' );


// If Dynamic Sidebar Exists
// if (function_exists('register_sidebar')){
//   register_sidebar(array(
//       'name' => __('Extra announcement', 'legalnetwork_theme'),
//       'description' => __('Ruimte voor speciale extra berichtgeving op homepage', 'legalnetwork_theme'),
//       'id' => 'extra-announcement',
//       'before_widget' => '<div class="container-fluid"><div class="row wrap-intro extra-announcement"><div class="col-xs-12 text-center">',
//       'after_widget' => '</div></div></div>',
//       'before_title' => '<h3>',
//       'after_title' => '</h3>'
//   ));
// }

/****************************************************************
   * SEARCH HOOK - only search in blog
****************************************************************/

function SearchFilter($query) {
  // If 's' request variable is set but empty
  if (isset($_GET['s']) && empty($_GET['s']) && $query->is_main_query()){
      $query->is_search = true;
      $query->is_home = false;
  }
  return $query;
}


// Load labi scripts (header.php)
function legalnetwork_header_scripts(){

  if (!is_admin()) {
  	wp_deregister_script('jquery');
  	wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js', array(), '1.10.1');
  	wp_enqueue_script('jquery');
  	
  	//wp_register_script('respondjs', 'http://externalcdn.com/respond-proxy.html', array(), '2.2.0');
    //wp_enqueue_script('respondjs');

    wp_register_script('conditionizr', 'http://cdnjs.cloudflare.com/ajax/libs/conditionizr.js/2.2.0/conditionizr.min.js', array(), '2.2.0');
    wp_enqueue_script('conditionizr');

    //wp_register_script('modernizr', get_template_directory_uri() . '/js/libs/modernizr.min.custom.js', array(), '2.6.2'); // Modernizr
    //wp_enqueue_script('modernizr');

    wp_register_script('grids', get_template_directory_uri() . '/js/libs/grids.min.js', array(), '2.6.2'); // Modernizr
    wp_enqueue_script('grids');

    wp_register_script('flexsliderjs', get_template_directory_uri() . '/js/libs/jquery.flexslider-min.js', array(), '2.6.2'); // Modernizr
    wp_enqueue_script('flexsliderjs');

    wp_register_script('backstretch', get_template_directory_uri() . '/js/libs/jquery-backstretch.min.js', array(), '3.1.1'); // bootstrap
    wp_enqueue_script('backstretch');

    wp_register_script('slidebarsjs', get_template_directory_uri() . '/js/libs/slidebars.js', array(), '3.1.1'); // bootstrap
    wp_enqueue_script('slidebarsjs');
    
    wp_register_script('bootstrap-js', get_template_directory_uri() . '/js/libs/bootstrap.min.js', array(), '3.1.1'); // bootstrap
    wp_enqueue_script('bootstrap-js');
    
    //wp_register_script('backgroundsize-js', get_template_directory_uri() . '/js/libs/jquery.backgroundSize.js', array(), '3.1.1'); // bootstrap
    //wp_enqueue_script('backgroundsize-js');
    
   
    wp_register_script('labiscripts', get_template_directory_uri() . '/js/scripts.min.js', array(), '1.0.0'); 
    wp_enqueue_script('labiscripts'); 
  }
}


// Load labi styles
function legalnetwork_styles(){
	wp_register_style('google-opensans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600', array(), '1.0', 'all');
  wp_enqueue_style('google-opensans');

  wp_register_style('font-awesome', 'http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css', array(), '4.0.3', 'all');
  wp_enqueue_style('font-awesome'); 

  //wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '1.0', 'all');
  //wp_enqueue_style('normalize'); 

  wp_register_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.1.1', 'all');
  wp_enqueue_style('bootstrap-css'); 

  wp_register_style('flexslider', get_template_directory_uri() . '/css/flexslider.min.css', array(), '1.0', 'all');
  wp_enqueue_style('flexslider'); 

	wp_register_style('slidebars-style', get_template_directory_uri() . '/css/slidebars.min.css', array(), '1.0', 'all');
  wp_enqueue_style('slidebars-style');
  
  wp_register_style('legalnetwork_theme', get_template_directory_uri() . '/css/styles.min.css', array(), '1.0', 'all');
  wp_enqueue_style('legalnetwork_theme'); 
}


/** Script Queue */
//if (!is_admin()) add_action("wp_enqueue_scripts", "my_script_enqueue", 11);

//add_filter('the_content', 'add_post_content');

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

add_action('init', 'legalnetwork_header_scripts'); // Add Custom Scripts to wp_head
add_action('init', 'legalnetwork_setup' );
add_action('init', 'register_legalnetwork_menu'); // Add cotton Blank Menu
add_action('wp_enqueue_scripts', 'legalnetwork_styles'); // Add Theme Stylesheet

add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
add_filter('wp_page_menu', 'add_menuid');
//add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
//add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)


/****************************************************************
   * REMOVE DEFAULT WIDGETS
****************************************************************/

function remove_some_wp_widgets(){
  unregister_widget('WP_Widget_Calendar');
  unregister_widget('WP_Widget_Search');
  unregister_widget('WP_Widget_Recent_Comments');
  //unregister_widget('WP_Widget_Categories');
  unregister_widget('WP_Widget_Archives');
  unregister_widget('WP_Widget_Links');
  unregister_widget('WP_Widget_Meta');
  unregister_widget('WP_Widget_Tag_Cloud');
  unregister_widget('WP_Widget_RSS');
  //unregister_widget('WP_Nav_Menu_Widget');
  unregister_widget('WP_Widget_Pages');

}

add_action('widgets_init','remove_some_wp_widgets', 1);