<?php


add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}

// Air Frame Shortcode
function air_frame_shortcode( $atts ) {
	$a = shortcode_atts( array(
				'type' => 'AIR',
				'src' => ''
			), $atts);
	if ($a['type'] == 'AIR') {
		$type_var = "AIR Stamp of Approval";
	} elseif ($a['type'] == "HM") {
		$type_var = "Honorable Mention";
	}
	return '<div class="au-air-frame"><h2>' . $type_var . '</h2><iframe src="' . esc_attr($a['src']) . '" width="100%" height="600px"></iframe></div>';
}
add_shortcode( 'airframe', 'air_frame_shortcode' );

// Capsules CAPSULE Shortcode
function capsule_shortcode( $atts, $content = null ) {
	return '<div class="au-capsule"><h2>CAPSULE</h2><h4>' . do_shortcode($content) . '</h4></div>';
}
add_shortcode( 'capsule', 'capsule_shortcode' );

//Capsules Lesson Box Shortcode
function capsules_lessonbox_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
				'header' => ''
			), $atts);
	return '<div class="lesson-box"><header>' . esc_attr($a['header']) . '</header><div class="lesson-body">' . do_shortcode($content) . '</div></div>';
}
add_shortcode( 'capsules-lessonbox', 'capsules_lessonbox_shortcode' );


//Overview shortcode
function pp_shortcode( $atts, $content = null ) {
	//$progress = get_user_meta($userid, '_sfwd-course_progress', true);
  $progress = 'Hello World!';
  return '<p>' . $progress . '</p>';
}
add_shortcode( 'pp', 'pp_shortcode' );

// Ultimate Member Course Dashboard Profile Tab
  /* Add a Course Dashboard tab to show LeardDash Profile */
  add_filter('um_profile_tabs', 'coursedash_tab', 1000);
  function coursedash_tab( $tabs ) {
  	$tabs['coursedash'] = array(
  		'name' => 'Course Dashboard',
  		'icon' => 'um-faicon-list-alt',
  		'custom' => true
  	);
  	return $tabs;
  }

  /* Tell the tab to display LearnDash Profile */
  add_action('um_profile_content_coursedash_default', 'um_profile_content_coursedash_default');
  function um_profile_content_coursedash_default( $args ) {
    echo do_shortcode('[ld_profile]');
  }


// Ultmate Member Educator Dashboard Functionality
    /* Add Educator Dashboard Tab */
    add_filter('um_profile_tabs', 'edudash_tab', 1000);
    function edudash_tab( $tabs ) {
    	$tabs['edudash'] = array(
    		'name' => 'Educator Dashboard',
    		'icon' => 'um-faicon-bar-chart',
    		'custom' => true
    	);
    	return $tabs;
    }

    /* Tell the tab what to display */
    add_action('um_profile_content_edudash_default', 'um_profile_content_edudash_default');
    function um_profile_content_edudash_default( $args ) {
      // Admin Role Check
      if (um_user('role_name') == 'Admin') {
      get_template_part( 'edudash' );
      }
      else{
        echo "Sorry but you need to have educator access to view this tab.";
      }

    }
?>
