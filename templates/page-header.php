<?php use Roots\Sage\Titles; ?>

<div class="page-header">
  <?php if ( (is_woocommerce()) && (apply_filters( 'woocommerce_show_page_title', true )) ) : ?>
    <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
  <?php else : ?>
    <h1><?= Titles\title(); ?></h1>
  <?php endif; ?>

</div>
