<header class="banner">
  <div class="container">
    <a href="/" class="mobile-logo">
      <img src="<?php bloginfo('template_directory'); ?>/dist/images/bclogo.png" alt="Logo image">
    </a>
    <nav class="nav-primary">
      <?php
      if (has_nav_menu('single_page_nav')) :
        wp_nav_menu(['theme_location' => 'single_page_nav', 'menu_class' => 'nav']);
      endif;
      ?>
    </nav>
  </div>
</header>
