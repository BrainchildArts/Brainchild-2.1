<?php  /* Template Name: Installtions */ ?>
<section class="installations">
  <div class="lineup-overlays">

    <?php
    $lineupargs = array (
      'post_type'     => 'artists',
      'nopaging'      => true,
      'orderby'       => 'name',
      'tag'           => 'installationartist',
      'order'         => 'ASC'
    );
    // The Query
    $lineup = new WP_Query( $lineupargs );

    // The Loop
    while ($lineup->have_posts()) : $lineup->the_post();
      get_template_part('templates/content-lineup', get_post_type() != 'post' ? get_post_type() : get_post_format());
      endwhile;?>

  </div>
  <?php wp_reset_postdata(); ?>

  <div class="artist__grid">

      <?php
      $lineupargs = array (
        'post_type'     => 'artists',
        'nopaging'      => true,
        'orderby'       => 'name',
        'tag'           => 'installationartist',
        'order'         => 'ASC'
      );
      // The Query
      $lineup = new WP_Query( $lineupargs );

      // The Loop
      while ($lineup->have_posts()) : $lineup->the_post();
        get_template_part('templates/content-lineup', get_post_type() != 'post' ? get_post_type() : get_post_format());
        endwhile;?>

    <?php wp_reset_postdata(); ?>


  </div>
</section>
