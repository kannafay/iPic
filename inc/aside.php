<aside>
  <?php
    wp_nav_menu(array( 
      'theme_location'  => 'main_menu',
      'container_class' => 'main_menu',
      'fallback_cb'     => 'menu_fallback'
    ));
  ?>
  <script>
    $('.main_menu > ul > li.menu-item-has-children > a').append('<span class="arrow iconfont icon-RectangleCopy8"></span>');
  </script>
</aside>