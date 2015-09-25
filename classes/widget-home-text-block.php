<?php

class Widget_Blue_Home extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array(
                'classname'     => 'home-text-widget',
                'description'   => __( "Toon alle rechtsgebieden")
            );
        parent::__construct( 'home-text-widget', __('Home Blue Block'), $widget_ops );
    }

    function form( $instance )
    {
        $title     	= esc_attr( isset( $instance['title'] ) ? $instance['title'] : '' );
        $content   	= esc_attr( isset( $instance['content'] ) ? $instance['content'] : '' );
        $label      = esc_attr( isset( $instance['my_label'] ) ? $instance['my_label'] : '' );
        $btn_link      = esc_attr( isset( $instance['my_link'] ) ? $instance['my_link'] : '' );
?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        

        <p>
            <label for="<?php echo $this->get_field_id( 'my_label' ); ?>"><?php _e( 'Button label:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'my_label' ); ?>" name="<?php echo $this->get_field_name( 'my_label' ); ?>" type="text" value="<?php echo $label; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'my_link' ); ?>"><?php _e( 'Button URL:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'my_link' ); ?>" name="<?php echo $this->get_field_name( 'my_link' ); ?>" type="text" value="<?php echo $btn_link; ?>" />
        </p>


<?php
    }

    function widget( $args, $instance )
    {
      extract($args);

      $title     	= $instance['title'];
      $content   	= $instance['content'];
      $label      = $instance['my_label'];
      $btn_link   = $instance['my_link'];

      echo $before_widget;
?>
	            

          <?php if( !empty( $title ) ) : ?>
            <h2><?php echo $title; ?></h2>
          <?php endif; ?>
          
          <?php if( !empty( $label ) ) : ?>
            <a href="<?php echo $btn_link; ?>" class="btn-more btn-white"><?php echo $label; ?></a>
          <?php endif; ?>

          <?php if( !empty( $content ) ) : ?>
            <p><?php echo $content; ?></p>
          <?php endif; ?>
              
                          
<?php

        echo $after_widget;
    }

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;

        $instance['title']      	= strip_tags( $new_instance['title'] );
        $instance['content']    	= $new_instance['content'];
        $instance['my_label']   = strip_tags( $new_instance['my_label'] );
        $instance['my_link']   = strip_tags( $new_instance['my_link'] );
		
        return $instance;
    }
}

?>