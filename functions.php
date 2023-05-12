<?php

add_action('admin_menu', 'add_theme_options_menu');
function add_theme_options_menu() {
  add_menu_page(
    'iPic主题设置',
    'iPic主题设置',
    'edit_themes',
    'ipic_option',
    'ipic_option_admin'
  );
}

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

if(get_option('ipic_private')) {
  welcome();
}

function ipic_option_admin() {
  require get_template_directory()."/admin/option.php";
}

// 引入自定义文件
function file_url() {
  return get_template_directory_uri();
}

function get_the_head() {
  require 'inc/head.php';
}

function get_the_home() {
  require 'inc/home.php';
}

function get_the_single() {
  require 'inc/content-single.php';
}

function get_the_page() {
  require 'inc/content-page.php';
}

function get_the_aside() {
  require 'inc/aside.php';
}

function get_the_foot() {
  require 'inc/foot.php';
}


// 网站分页
require 'inc/modules/pagination.php';

// 面包屑导航
require 'inc/modules/breadcrumb.php';

// 自动添加页面模板
require 'inc/modules/add-page.php';


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
  // 'side_menu' => '侧边栏菜单',
));

function main_menu_fallback() {
  if(1) {
    echo '<div class="main_menu">
      <ul class="menu">
        <li><a href="'.home_url().'/" class="active">网站首页</a></li>
        <li><a href="'.home_url().'/wp-admin/nav-menus.php" class="menu-set">设置菜单</a></li>
      </ul>
    </div>';
  } else {
    echo '<div class="main_menu">
      <ul class="menu">
        <li><a href="'.home_url().'" class="active">网站首页</a></li>
      </ul>
    </div>';
  }
}

function icp_gov_url() {
  if(get_option("ipic_icp_gov")) { 
    $patterns = "/\d+/";
    $strs = get_option("ipic_icp_gov");
    preg_match_all($patterns,$strs,$arr);
    $icp_gov_url = 'https://www.beian.gov.cn/portal/registerSystemInfo?recordcode='.implode($arr[0]);
  }
  return $icp_gov_url;
}