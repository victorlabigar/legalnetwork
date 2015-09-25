<?php

class Widget_Tax extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array(
                'classname'     => 'tax-widget',
                'description'   => __( "Toon alle rechtsgebieden")
            );
        parent::__construct( 'tax-widget', __('Rechtsgebieden Sidebar'), $widget_ops );
    }

    function form( $instance )
    {
        $title     	= esc_attr( isset( $instance['title'] ) ? $instance['title'] : '' );
        $content   	= esc_attr( isset( $instance['content'] ) ? $instance['content'] : '' );
        $show_count = esc_attr( isset( $instance['show_count'] ) ? $instance['show_count'] : '' );
        //$amount_cats = esc_attr( isset( $instance['amount_cats'] ) ? $instance['amount_cats'] : '' );
?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
            </label>
        </p>
        <p>
           <label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e( 'Content:' ); ?></label>
           <textarea class="widefat" rows="4" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" ><?php echo $content; ?></textarea>
            
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'show_count' ); ?>"><?php _e( 'Show counter:' ); ?>
                <input class="widefat" id="<?php echo $this->get_field_id( 'show_count' ); ?>" name="<?php echo $this->get_field_name( 'show_count' ); ?>" type="text" value="<?php echo $show_count; ?>" />
            </label>
        </p>


<?php
    }

    function widget( $args, $instance )
    {
        extract($args);

        $title     	= $instance['title'];
        $content   	= $instance['content'];
        $show_count = $instance['show_count'];


        echo $before_widget;

        //list terms in a given taxonomy using wp_list_categories  (also useful as a widget)
        $orderby = 'name';
        $show_count_cat = $show_count; // 1 for yes, 0 for no
        $pad_counts = 0; // 1 for yes, 0 for no
        $hierarchical = 1; // 1 for yes, 0 for no
        $taxonomy = 'rechtsgebieden';
        $titleCat = '';
        $exclude = '';
        //$number_cat = $number;
        $hideempty = 0;

        $argsNew = array(
          'orderby' => $orderby,
          'show_count' => $show_count_cat,
          'pad_counts' => $pad_counts,
          'hierarchical' => $hierarchical,
          'taxonomy' => $taxonomy,
          'title_li' => $titleCat,
          'exclude' => $exclude,
          //'number' => $number_cat,
          'hide_empty' => $hideempty
        );

?>
	            <?php if( !empty( $title ) ) : ?>
                <h2><?php echo $title; ?></h2>
              <?php endif; ?>

              <?php if( !empty( $content ) ) : ?>
                <p><?php echo $content; ?></p>
              <?php endif; ?>
              
              <ul class="categories-expertises">
                <?php 
                  wp_list_categories($argsNew);
                ?>  
              </ul>
              
              
<?php

        echo $after_widget;
    }

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;

        $instance['title']      	= strip_tags( $new_instance['title'] );
        $instance['content']    	= $new_instance['content'];
        $instance['show_count']   = strip_tags( $new_instance['show_count'] );
        //$instance['amount_cats']  = strip_tags( $amount_cats['amount_cats'] ); 
		
        return $instance;
    }
}

?>