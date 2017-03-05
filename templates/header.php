<header class="banner">
  <div class="container">
    <a href="#" id="js-mobile-menu" class="menu-icon"></a>
    <nav class="nav-primary">
      <?php
      if ( is_front_page() ) :
        wp_nav_menu(['theme_location' => 'single_page_nav', 'menu_class' => 'nav']);
      endif;
      if ( !is_front_page() ) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
      endif;
      ?>
      <?php if ( !is_front_page() && WC()->cart->get_cart_contents_count() > 0) : ?>
        <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
          <span><?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span>
          <img src="<?php bloginfo('template_directory'); ?>/dist/images/partials/basket.svg"></a>
      <?php endif; ?>
    </nav>
  </div>
</header>
