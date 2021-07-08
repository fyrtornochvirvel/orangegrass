<?php 

// ------------ Stylesheets ------------
  function orangegrass_resources() {
    wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css' );
    wp_enqueue_style('skeleton', get_template_directory_uri() . '/css/skeleton.css' );
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'); 
  }

  add_action('wp_enqueue_scripts', 'orangegrass_resources');

// ------------ Google Fonts ------------
  function load_fonts() {
    wp_register_style('ubuntu', '//fonts.googleapis.com/css?family=Ubuntu:400,300,500,300italic');
    wp_register_style('montserrat', '//fonts.googleapis.com/css?family=Montserrat:400,700');
    wp_enqueue_style( 'ubuntu');
    wp_enqueue_style( 'montserrat');
  }

  add_action('wp_print_styles', 'load_fonts');

// ------------ Menu ------------
  register_nav_menus(array(
      'primary' => __( 'Huvudmeny'),
  ));

// ------------ Menu Trigger ------------
  function menu_trigger() {
    wp_register_script( 'menu_trigger', get_stylesheet_directory_uri() . '/js/menu-trigger.js', array( 'jquery' ) );
    wp_enqueue_script( 'menu_trigger' );
  }

  add_action( 'wp_enqueue_scripts', 'menu_trigger' );

// ------------ Feature Image & Post Format ------------
  add_theme_support( 'post-thumbnails' );
  add_image_size('post-background', 1280, 9999);
  add_theme_support( 'post-formats', array( 'status' ));

// ------------ Embed Responsive ------------
  function embed_responsive( $html ) {
      return '<div class="video-container">' . $html . '</div>';
  }

  add_filter( 'embed_oembed_html', 'embed_responsive', 10, 3 );
  add_filter( 'video_embed_html', 'embed_responsive' );

// ------------ Custom Excerpt ------------

  function custom_excerpt_length( $length ) {
     return 50;
  }
  add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

  function custom_excerpt_more($more) {
     global $post;
     return '... <p class="read-more"><a href="'. get_permalink($post->ID) . '">'. __('Fortsätt läsa', 'orangegrass') .'</a></p>';
  }
  add_filter('excerpt_more', 'custom_excerpt_more');

// ------------ Embed Gfycat ------------

  wp_embed_register_handler('gfycat', '#http(s)?://(www\.)?gfycat.com/(.*)#i', 'embed_gfycat_api');

  function embed_gfycat_api($matches)
  {
      $id = $matches[3];

      $url = 'http://gfycat.com/cajax/get/' . $id;
      $json_resp = wp_remote_get($url);

      $json = json_decode($json_resp['body']);

      $gfy = $json->gfyItem;

      $max_width = 1280;
      $o_width = $gfy->width;
      $o_height = $gfy->height;
      $ratio = $o_height / $o_width;
      $width = $o_width > $max_width ? $max_width : $o_width;
      $height = $o_width > $max_width ? round($max_width * $ratio) : $o_height;

      $html = '<video id="gfyVid" class="gfyVid" width="' . $width . '" height="' . $height . '" autoplay="" loop="" muted="muted" style="display: block;" poster="//thumbs.gfycat.com/' . $id . '-poster.jpg">

          <source id="webmsource" src="' . $gfy->webmUrl . '" type="video/webm">
          <source id="mp4source" src="' . $gfy->mp4Url . '" type="video/mp4">
          Visa gif:en direkt hos: <a href="' . $gfy->gifUrl . '">' . $gfy->gifUrl . '</a> 
      </video>';

      return $html;
  }

// ------------ Social Icons ------------

  function share_buttons($content) {

    if(is_single()){

      $shortURL = get_permalink();

      $shortTitle = str_replace( ' ', '%20', get_the_title());

      $twitterURL = 'https://twitter.com/intent/tweet?text='.$shortTitle.'&amp;url='.$shortURL.'';
      $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$shortURL;

      $content .= '<section class="share">';
      $content .= '<a class="share-link share-twitter" href="'. $twitterURL .'" target="_blank"><i class="fa fa-twitter"></i> Twittra</a>';
      $content .= '<a class="share-link share-facebook" href="'.$facebookURL.'" target="_blank"><i class="fa fa-facebook"></i> Dela</a>';
      $content .= '</section>';

      return $content;

    } else{

      return $content;

    }
  };

  add_filter( 'the_content', 'share_buttons');

// ------------ Gallery Styling ------------

  add_filter( 'use_default_gallery_style', '__return_false' );

?>