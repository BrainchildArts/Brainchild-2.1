<header class="banner">
  <div class="container">
    <button id="js-mobile-menu" class="menu-icon hamburger hamburger--boring" type="button">
      <span class="hamburger-box">
        <span class="hamburger-inner"></span>
      </span>
    </button>
    <nav class="nav-primary">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
      endif;
      ?>
      <?php /* if ( !is_front_page() && WC()->cart->get_cart_contents_count() > 0) : ?>
        <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'Basket - ' ); printf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); _e( ' items' );?> ">
          <img src="<?php bloginfo('template_directory'); ?>/dist/images/partials/basket.svg">
          <span><?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span>
        </a>
      <?php endif; */ ?>
    </nav>
  </div>
</header>
