<header class="banner">
  <div class="container">
    <a href="#" class="menu-icon"></a>
    <nav class="nav-primary">
      <?php
      if ( is_front_page() ) :
        wp_nav_menu(['theme_location' => 'single_page_nav', 'menu_class' => 'nav']);
      endif;
      if ( !is_front_page() ) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
      endif;
      ?>
    </nav>
  </div>
</header>
