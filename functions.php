<?php

// welcome!!!
function welcome() {
  if ( !is_user_logged_in() && !is_login()) {
    $current_url = home_url(add_query_arg(array()));
    $blog_url1 = home_url().'/welcome';
    $blog_url2 = home_url().'/welcome/';
    if ( $current_url != $blog_url1 && $current_url != $blog_url2 ) {
      wp_redirect( '/welcome', 302 );
    }
  }
}

// welcome();


// 引入自定义文件
function file_url() {
  return get_template_directory_uri();
}

function get_head() {
  require 'inc/head.php';
}

function get_home() {
  require 'inc/home.php';
}

function get_single() {
  require 'inc/content.php';
}

function get_aside() {
  require 'inc/aside.php';
}

function get_foot() {
  require 'inc/foot.php';
}


// 缩略图
if( function_exists('add_theme_support') ) {
  add_theme_support('post-thumbnails', array('post','page'));
}

function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post -> post_content, $matches);
  if( !isset($matches[1][0]) )
    $first_img = file_url().'/assets/images/default.jpg';
  else
    $first_img = $matches[1][0];
  return $first_img;
}



// 网站分页
function wp_pagination() {
  global $wp_query, $wp_rewrite;
  $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;  
  $pagination = array(
    'base' => @add_query_arg('paged','%#%'),
    'format' => '',
    'total' => $wp_query->max_num_pages,
    'current' => $current,
    'show_all' => false,
    'type' => 'plain',
    'end_size'=>'2',
    'mid_size'=>'2',
    'prev_text' => '<', //♂
    'next_text' => '>' //♀
  ); 
  if( $wp_rewrite -> using_permalinks() )
    $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');
  if( !empty($wp_query -> query_vars['s']) )
    $pagination['add_args'] = array('s'=>get_query_var('s'));
  echo paginate_links($pagination);
}

if( home_url(add_query_arg(array())) == home_url().'/page/1' ) {
  wp_redirect( home_url(), 302);
}


// 网站标题
function show_wp_title(){
  global $page, $paged;
  wp_title( '&#8211;', true, 'right' );
  bloginfo( 'name' );
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    echo ' &#8211; ' . $site_description;
  if ( $paged >= 2 || $page >= 2 )
    echo ' &#8211; ' . sprintf( '第%s页', max( $paged, $page ) );
}


// 面包屑导航
require 'inc/modules/breadcrumb.php';


// 搜索排除页面
add_filter('pre_get_posts', function($wp_query){
  if( $wp_query -> is_search ){
    $wp_query -> set('post_type', 'post');
  }
  return $wp_query;
});


// 注册菜单
register_nav_menus(array(        
  'main_menu' => '顶部菜单',
  'side_menu' => '侧边栏菜单',
));