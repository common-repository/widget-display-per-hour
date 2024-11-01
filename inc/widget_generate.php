<?php 
class widget_images_per_hour extends WP_Widget {
  function __construct() {
    $widget_ops = array('classname' => 'widget_images_tutocms', 'description' => __('Create Widget display per hour'));
    parent::__construct('tutocsm_widget_img', __('Create Widget display per hour'), $widget_ops);
  }

  //This is to display 
  public function widget( $args, $instance ) {

    $url = plugins_url().'/widget_display_per_hour/inc/houractual.php';
    $data = base64_encode(json_encode($instance));
    ?>
    <input type="hidden" class="data-widget-all" value='<?php echo $data; ?>' url ='<?php echo $url; ?>'> 
    <?php 
    echo $args['before_widget'];
    ?>
    <div class="cont-result">
      <div class="title"></div>
      <div class="body"></div>
      <div class="images"></div>
    </div>
    <?php
    echo $args['after_widget'];
  }

//this is a update widget
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;

    $instance['title'] = strip_tags($new_instance['title']);
    $instance['startime_hour'] = strip_tags($new_instance['startime_hour']);
    $instance['startime_min'] = strip_tags($new_instance['startime_min']);
    $instance['endtime_hour'] = strip_tags($new_instance['endtime_hour']);
    $instance['endtime_min'] = strip_tags($new_instance['endtime_min']);


    if ( current_user_can('unfiltered_html') )
      $instance['text'] =$new_instance['text'];
    else
      $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) );
    return $instance;
  }

//this is a Form widget
  public function form( $instance ) {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '','endtime_hour'=> '','endtime_min'=>'','startime_hour'=>'','startime_min'=>'') );

    $title = strip_tags($instance['title'], $this->id_base);
    $text = esc_textarea($instance['text']);
    $startime_hour = strip_tags($instance['startime_hour']);
    $startime_min = strip_tags($instance['startime_min']);
    $endtime_hour = strip_tags($instance['endtime_hour']);
    $endtime_min = strip_tags($instance['endtime_min']);

    ?>
    <div class="widget-form-tutocms_img">

      <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Content:' ); ?></label> 
        <textarea class="widefat tutocms-widget" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
      </p>

      <div class="item date">
        <div class="cont_date">
          <b>Star hour:</b>
          <p>
            <label for="<?php echo $this->get_field_id( 'startime_hour' ); ?>"><?php _e( 'Hour:' ); ?></label> 
            <input type="number" id="<?php echo $this->get_field_id( 'startime_hour' ); ?>" name="<?php echo $this->get_field_name( 'startime_hour' ); ?>" min="0" max="24" value="<?php echo esc_attr( $startime_hour ); ?>">
          </p>
          <p>
            <label for="<?php echo $this->get_field_id( 'startime_min' ); ?>"><?php _e( 'Minute:' ); ?></label> 
            <input type="number" id="<?php echo $this->get_field_id( 'startime_min' ); ?>" name="<?php echo $this->get_field_name( 'startime_min' ); ?>" min="0" max="60" value="<?php echo esc_attr( $startime_min ); ?>">
          </p>
        </div>
      </div>

      <div class="item date">
        <div class="cont_date">
          <b>End hour:</b>
          <p>
            <label for="<?php echo $this->get_field_id( 'endtime_hour' ); ?>"><?php _e( 'Hour:' ); ?></label> 
            <input type="number" id="<?php echo $this->get_field_id( 'endtime_hour' ); ?>" name="<?php echo $this->get_field_name( 'endtime_hour' ); ?>" min="0" max="24" value="<?php echo esc_attr( $endtime_hour ); ?>">
          </p>
          <p>
            <label for="<?php echo $this->get_field_id( 'endtime_min' ); ?>"><?php _e( 'Minute:' ); ?></label> 
            <input type="number" id="<?php echo $this->get_field_id( 'endtime_min' ); ?>" name="<?php echo $this->get_field_name( 'endtime_min' ); ?>" min="0" max="60" value="<?php echo esc_attr( $endtime_min ); ?>">
          </p>
        </div>
      </div>



    </div>

    <?php
  }
}
add_action('widgets_init', create_function('', 'return register_widget("widget_images_per_hour");'));
