<div class='muted' id='sound'>
  <img class='black' src='<?php bloginfo('template_directory'); ?>/dist/images/partials/note.svg'>
  <img class='white' src='<?php bloginfo('template_directory'); ?>/dist/images/partials/note--white.svg'>
</div>
<section class='splash' id="splash">
  <div class="splash-content splash__frame"></div>
  <div id="video_background" class="headervideo responsive"></div>
  <div class='splash__text splash-content content'>
    <img class='logo splash-content' src='<?php bloginfo('template_directory'); ?>/dist/images/partials/bclogo.png'>
    <h3 class='splash-content'>Festival 2017</h3>
    <h2 class='dates splash-content'>7-9 July</h2>
    <h2 class='location splash-content'>East Sussex</h2>
  </div>
</section>

<?php get_template_part('templates/socials') ?>



<!-- Splash Section -->
<section class="main-section" id="about">
  <div id="manifesto" class="main-section__text">
    <h2 class="scatterText">Welcome</h2>
    <?php the_field('welcome_text'); ?>
  </div>
  <div class="images">
    <img class="left" src="<?php bloginfo('template_directory'); ?>/dist/images/cutouts/cutout-1.svg">
    <img class="right" src="<?php bloginfo('template_directory'); ?>/dist/images/cutouts/cutout-3.svg">
  </div>
</section>



<section class="main-section tickets" id="tickets">
  <div class="tickets__links">
    <h1><?php the_field('ticket_header'); ?></h1>
    <?php get_template_part('templates/ticket_buttons') ?>
  </div>
</section>



<section class="main-section" id="lineup">
  <div class="main-section__text"><?php the_field('lineup_text'); ?></div>
  <?php get_template_part('templates/lineup-list') ?>

  <div class="lineup-overlays">

    <?php
    $lineupargs = array (
      'post_type'     => 'artists',
      'nopaging'      => true,
      'orderby'       => 'name',
      'order'         => 'ASC'
    );
    // The Query
    $lineup = new WP_Query( $lineupargs );

    // The Loop
    while ($lineup->have_posts()) : $lineup->the_post();
      get_template_part('templates/content-lineup', get_post_type() != 'post' ? get_post_type() : get_post_format());
      endwhile;?>

  </div>

  <?php if (get_field('lineup_text_2')): ?>
    <div class="main-section__text"><?php the_field('lineup_text_2'); ?></div>
  <?php endif ?>
</section>



<section class="main-section bc-words" id="bc-words">
  <h2 class="scatterText">Writing</h2>
  <div class="bc-words__posts">
    <?php
    //Start recent post loop

    // WP_Query arguments

    $id = (get_the_id());

    $args = array (
    	'category_name'          => 'blog',
      'post__not_in'           => array($post->ID),
      'posts_per_page'         => '3',
    );

    // The Query
    $query = new WP_Query( $args );

      // The Loop
    if ( $query->have_posts() ) {
      while ($query->have_posts()) : $query->the_post();
        get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format());
      endwhile;
    } else {
      //no posts found
    }

    // Restore original Post Data
    wp_reset_postdata();
    ?>
    </div>
    <a class="bc-words-allposts" href="/blog">See all posts...</a>
</section>



<section class="main-section gallery" id="gallery">
  <div class="slide slide-1">
  <?php
  if ( get_post_gallery() ) {

      $gallery        = get_post_gallery( get_the_ID(), false );
      $galleryIDS     = $gallery['ids'];
      $pieces         = explode(",", $galleryIDS);

      foreach ($pieces as $key => $value ) {

          $image_large   = wp_get_attachment_image_src( $value, 'gallery');
          $image_full     = wp_get_attachment_image_src( $value, 'large');
      ?>


              <a href="<?php echo $image_full[0] ?>"  class="slide__image zoom-in">
                  <img src="<?php echo $image_large[0] ?>"/>
              </a>
      <?php
      }
  }
  ?>
  </div>
  <p class="big-txt">Photography: <a target="_blank" href="http://www.holliefernandophotography.com/">Hollie Fernando</a></p>
</section>

<section class="main-section volunteering" id="volunteering">
  <h2 class="scatterText">Volunteer</h2>
  <?php the_field('volunteering_text') ?>
  <a class="ticket-link button cta volunteer-link" href="http://buytickets.at/brainchildfestival/80298/r/website" target="_blank">Buy a Ticket</a>
</section>

<section class="main-section getinvolved" id="getinvolved">
  <h2 class="scatterText">Get In Touch</h2>
  <?php the_field('get_involved_text'); ?>
</section>

<footer>
  <?php the_field('footer_text'); ?>
</footer>

<?php get_template_part('templates/player') ?>
