<?php
/**
 * Plugin Name: New Widget
 * Plugin URI: https://github.com/Surfing-Chef/new-widget
 * Description: A simple widget to practice creating a simple widget
 * Version: 1.0
 * Author: Surfing-Chef
 * Author URI: https://github.com/Surfing-Chef
 * License: GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: sc-new-widget
*/
class sc_New_Widget extends WP_Widget {

  // Registers basic widget information
  public function __construct()
  { /**
     * Constructor creates the widget id, widget name
     * and widget options
    */
    $widget_options = array(
      'classname' => 'new_widget',
      'description' => 'This is a New Widget',
    );
    parent::__construct( 'new_widget', 'New Widget', $widget_options );
  }

  // Generates the actual content displayed by the widget
  public function widget( $args, $instance )
  { /**
     * $args[]: this variable loads an array of arguments which can be used when building widget output.
     * The values contained in $args are set by the active theme when the sidebar region is registered.
     * $instance[]: this variable loads values associated with the current instance of the widget.
     * If a widget is added twice each $instance would hold the values specific to each instance of the widget.
     * widget_title filter: returns the title of the current widget instance
    */
    $title = apply_filters( 'widget_title', $instance[ 'title' ] );
    $blog_title = get_bloginfo( 'name' );
    $tagline = get_bloginfo( 'description' );
    echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title']; ?>

    <p><strong>Site Name:</strong> <?php echo $blog_title ?></p>
    <p><strong>Tagline:</strong> <?php echo $tagline ?></p>

    <?php echo $args['after_widget'];
  }

  // Adds setting fields to the widget which will be displayed
  // in the WordPress admin area
  public function form( $instance )
  { /**
     * Check the current instance information to see if the title is empty. If it isn’t, the current title gets displayed.
    */
    $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
      <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
    </p><?php
  }

  // Update the information in the WordPress database
  public function update( $new_instance, $old_instance )
  { /**
     * $new_instance contains the values added to the widget settings form
     * $old_instance contains the existing settings — if any exist
     * Grab values from the new instance,
     * strip away any HTML or PHP tags that may have added to the values,
     * assign new values to the instance,
     * return the updated instance.
    */
    $instance = $old_instance;
    $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
    return $instance;
  }
}

// Register the Widget
function sc_register_new_widget()
{ /**
   * specify widget to register using the widget object's name
  */
  register_widget( 'sc_New_Widget' );
}

// Tie the registration funcion to WordPress using the widgets_init hook
add_action( 'widgets_init', 'sc_register_new_widget' );
?>
