<aside>
  <?php
    wp_nav_menu(array( 
      'theme_location'  => 'main_menu',
      'container_class' => 'main_menu',
      'fallback_cb'     => 'menu_fallback'
    ));
  ?>
</aside>