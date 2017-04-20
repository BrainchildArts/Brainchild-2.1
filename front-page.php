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
  <div id="welcome" class="main-section__text">
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



<?php $highlights = get_posts('category_name=highlights');
if ($highlights) { ?>
  <section class="home__section main-section highlights" id="highlights">
    <h2 class="scatterText">Highlights</h2>
    <div class="posts">
    <svg class="highlights-background" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1410.44 852.3"><g><path d="M0,364.62C1,302.4,12.21,242.49,35.94,185c14.83-35.93,35.67-68.68,62.93-95.62C127.73,60.85,159,33.81,200,22.6c11.69-3.19,23-7.84,34.45-11.86,36-12.64,72.23-13.85,109.46-5.07C422.79,24.26,498.36,51,569.39,90.49a564.11,564.11,0,0,0,74.84,34.26c37.07,14,74.87,12.95,112.94,1.47,30.56-9.21,61.58-17.13,92.75-24,38.49-8.5,77.48-7,116.46-2.55,29.2,3.35,58.6,6.31,87.84,1.5,11.09-1.83,22.65-5.4,32.19-11.17a389.06,389.06,0,0,1,98.45-42.26c52.9-14.52,103.91-7.71,150.94,21.74A78.91,78.91,0,0,1,1353,84.56c35.61,41,56.25,88.21,57.36,142.88.48,23.61-1.2,47.27-1.84,70.91-.71,26.55-9.78,50.71-20.56,74.55-31.63,70-60.42,141-79.07,215.69-11.94,47.86-16.78,96.72-20.56,145.71-1.89,24.44-5.29,48.45-20.87,68.45-5.37,6.89-12,13.66-19.45,17.92-25.17,14.31-52.89,22.36-80.6,30.18-12.93,3.64-25.4-.38-37.82-2.93-69.9-14.39-137.3-36-199-72.67-26.91-16-52.64-34-79.21-50.59-10.27-6.41-21.43-11.41-32.15-17.11-13.38-7.11-26.95-7.19-40.66-1.15-11.11,4.9-22.32,9.61-33.24,14.91-64.47,31.33-131,37-199.33,15.17-21.9-7-43.32-15.55-64.79-23.83-14.71-5.67-29.27-7.89-45-4-32.23,8.08-64.62,15.57-97,22.86-14.33,3.22-28.83,6-43.39,7.88-24.41,3.17-48.19.31-71.87-7.1-51.56-16.14-98.24-39.7-134.83-80.81C76.21,637,65.44,621.37,58.08,603.47,34.43,546,14.48,487.34,5.18,425.66,2.14,405.51,1.66,385,0,364.62Z"/></g></svg>
      <?php
      //Start recent post loop

      // WP_Query arguments

      $id = (get_the_id());

      $args = array (
        'category_name'          => 'highlights',
        'post__not_in'           => array($post->ID),
        'posts_per_page'         => '0',
      );

      // The Query
      $query = new WP_Query( $args );

        // The Loop
      if ( $query->have_posts() ) {
        while ($query->have_posts()) : $query->the_post();
          get_template_part('templates/content-highlights', get_post_type() != 'post' ? get_post_type() : get_post_format());
        endwhile;
      } else {
        //no posts found
      }

      // Restore original Post Data
      wp_reset_postdata();
      ?>
   </div>
 </section>
<?php } ?>




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
