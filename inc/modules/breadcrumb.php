<?php

function the_breadcrumb() {
  if ( is_front_page() ) {
    return;
  }
  global $post;
  $custom_taxonomy  = '';

  $defaults = array(
    'seperator'   =>  '',
    'id'          =>  '',
    'classes'     =>  'breadcrumb',
    'home_title'  =>  esc_html__( '首页', '' )
  );
  $sep  = '<li class="seperator">'. esc_html( $defaults['seperator'] ) .'</li>';
  echo '<ul data-pjax id="'. esc_attr( $defaults['id'] ) .'" class="'. esc_attr( $defaults['classes'] ) .'">';
  echo '<li class="item"><a href="'. get_home_url() .'">'. esc_html( $defaults['home_title'] ) .'</a></li>' . $sep;
  if ( is_single() ) {
    $post_type = get_post_type();
    if( $post_type != 'post' ) {
      $post_type_object   = get_post_type_object( $post_type );
      $post_type_link     = get_post_type_archive_link( $post_type );
      echo '<li class="item item-cat"><a href="'. $post_type_link .'">'. $post_type_object->labels->name .'</a></li>'. $sep;
    }
    $category = get_the_category( $post->ID );
    if( !empty( $category ) ) {
      $category_values      = array_values( $category );
      $get_last_category    = end( $category_values );
      $get_parent_category  = rtrim( get_category_parents( $get_last_category->term_id, true, ',' ), ',' );
      $cat_parent           = explode( ',', $get_parent_category );
      $display_category = '';
      foreach( $cat_parent as $p ) {
        $display_category .=  '<li class="item item-cat">'. $p .'</li>' . $sep;
      }
    }
    $taxonomy_exists = taxonomy_exists( $custom_taxonomy );
    if( empty( $get_last_category ) && !empty( $custom_taxonomy ) && $taxonomy_exists ) {
      $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
      $cat_id         = $taxonomy_terms[0]->term_id;
      $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
      $cat_name       = $taxonomy_terms[0]->name;
    }
    if( !empty( $get_last_category ) ) {
      echo $display_category;
      echo '<li class="item item-current">'. '正文' .'</li>';
    } else if( !empty( $cat_id ) ) {
      echo '<li class="item item-cat"><a href="'. $cat_link .'">'. $cat_name .'</a></li>' . $sep;
      echo '<li class="item-current item">'. '正文' .'</li>';
    } else {
      echo '<li class="item-current item">'. '正文' .'</li>';
    }
  } else if( is_archive() ) {
    if( is_tax() ) {
      $post_type = get_post_type();
      if( $post_type != 'post' ) {
        $post_type_object   = get_post_type_object( $post_type );
        $post_type_link     = get_post_type_archive_link( $post_type );
        echo '<li class="item item-cat item-custom-post-type-' . $post_type . '"><a href="' . $post_type_link . '">' . $post_type_object->labels->name . '</a></li>' . $sep;
      }
      $custom_tax_name = get_queried_object()->name;
      echo '<li class="item item-current">'. $custom_tax_name .'</li>';
    } else if ( is_category() ) {
      $parent = get_queried_object()->category_parent;
      if ( $parent !== 0 ) {
        $parent_category = get_category( $parent );
        $category_link   = get_category_link( $parent );
        echo '<li class="item"><a href="'. esc_url( $category_link ) .'">'. $parent_category->name .'</a></li>' . $sep;
      }
      echo '<li class="item item-current">'. single_cat_title( '', false ) .'</li>';
    } else if ( is_tag() ) {
      $term_id        = get_query_var('tag_id');
      $taxonomy       = 'post_tag';
      $args           = 'include=' . $term_id;
      $terms          = get_terms( $taxonomy, $args );
      $get_term_name  = $terms[0]->name;
      echo '<li class="item-current item">'. $get_term_name .'</li>';
    } else if( is_day() ) {
      echo '<li class="item-year item"><a href="'. get_year_link( get_the_time('Y') ) .'">'. get_the_time('Y') . ' Archives</a></li>' . $sep;
      echo '<li class="item-month item"><a href="'. get_month_link( get_the_time('Y'), get_the_time('m') ) .'">'. get_the_time('M') .' Archives</a></li>' . $sep;
      echo '<li class="item-current item">'. get_the_time('jS') .' '. get_the_time('M'). ' Archives</li>';
    } else if( is_month() ) {
      echo '<li class="item-year item"><a href="'. get_year_link( get_the_time('Y') ) .'">'. get_the_time('Y') . ' Archives</a></li>' . $sep;
      echo '<li class="item-month item-current item">'. get_the_time('M') .' Archives</li>';
    } else if ( is_year() ) {
      echo '<li class="item-year item-current item">'. get_the_time('Y') .' Archives</li>';
    } else if ( is_author() ) {
      global $author;
      $userdata = get_userdata( $author );
      echo '<li class="item-current item">'. 'Author: '. $userdata->display_name . '</li>';
    } else {
      echo '<li class="item item-current">'. post_type_archive_title() .'</li>';
    }
  } else if ( is_page() ) {
    if( $post->post_parent ) {
      $anc = get_post_ancestors( $post->ID );
      $anc = array_reverse( $anc );
      if ( !isset( $parents ) ) $parents = null;
      foreach ( $anc as $ancestor ) {
        $parents .= '<li class="item-parent item"><a href="'. get_permalink( $ancestor ) .'">'. get_the_title( $ancestor ) .'</a></li>' . $sep;
      }
      echo $parents;
      echo '<li class="item-current item">'. '正文' .'</li>';
    } else {
      echo '<li class="item-current item">'. '正文' .'</li>';
    }
  } else if ( is_search() ) {
    echo '<li class="item-current item">Search results for: '. get_search_query() .'</li>';
  } else if ( is_404() ) {
    echo '<li class="item-current item">' . 'Error 404' . '</li>';
  }
  echo '</ul>';
}

?>