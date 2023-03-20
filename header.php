<header>
  <div class="menu-switch">
    <div class="box">
      <span class="open iconfont icon-RectangleCopy1"></span>
      <span class="close iconfont icon-RectangleCopy3"></span>
    </div>
  </div>

  <div class="center">
    <div class="title">
      <div class="the-title">
        <span id="title">
          <?php
            if( is_home() ) {
              global $page, $paged;
              bloginfo('name');
              if ( $paged >= 2 || $page >= 2 )
              echo ' &#8211; ' . sprintf( '第%s页', max( $paged, $page ) );

            } else if ( is_single() || is_page() ) {
              the_title();

            } else if ( is_archive() || is_category() || is_tag() ) {
              single_cat_title();

            } else if ( is_author() ) {
              the_author_nickname();

            } else if ( is_date() ) {
              the_time('Y年m月');
            } else if ( is_search() ) {
              the_search_query();
            }
          ?>
        </span>
      </div>
      <div class="backtop">
        <span>返回顶部</span>
      </div>
    </div>
    <div class="search">
      <form data-pjax method="get" action="<?php bloginfo('url') ?>">
        <input type="text" value="" name="s" placeholder="输入关键词，回车" autocomplete="off" required>
      </form>
    </div>
  </div>

  <div class="search-switch">
    <div class="box">
      <span class="open iconfont icon-RectangleCopy2"></span>
      <span class="close iconfont icon-RectangleCopy3"></span>
    </div>
  </div>
</header>