<section class='splash' id="splash">
  <div class='muted' id='sound'>
    <img class='black' src='<?php bloginfo('template_directory'); ?>/dist/images/partials/note.svg'>
    <img class='white' src='<?php bloginfo('template_directory'); ?>/dist/images/partials/note--white.svg'>
  </div>
  <div class="splash-content splash__frame"></div>
  <div id="video_background" class="headervideo responsive"></div>
  <div class='splash__text splash-content content'>
    <img class='logo splash-content' src='<?php bloginfo('template_directory'); ?>/dist/images/partials/bclogo.svg'>
    <h3 class='splash-content'>Festival 2019</h3>
    <h2 class='dates splash-content scatterText'>12-14 July</h2>
    <h2 class='location splash-content'>East Sussex</h2>
    <div class="mobile-socials"><?php get_template_part('templates/socials') ?></div>
  </div>
</section>




<!-- Splash Section -->
<section class="main-section" id="about">
  <div id="welcome" class="main-section__text main-section__text--columns">
    <h2 class="scatterText">Welcome</h2>
    <?php the_field('welcome_text'); ?>
  </div>
  <div class="images decor-image-container" >
    <div class="imageleft--gap">
      <img class="decor-image" data-stellar-ratio="1.2" src="<?php bloginfo('template_directory'); ?>/dist/images/cutouts/cutout-15-2.svg">
    </div>
    <div class="imageleft">
      <img class="decor-image" data-stellar-ratio="1.4" src="<?php bloginfo('template_directory'); ?>/dist/images/cutouts/cutout-22.svg">
    </div>
    <div class="imageright">
      <img class="decor-image" data-stellar-ratio="1.4" src="<?php bloginfo('template_directory'); ?>/dist/images/cutouts/cutout-11.svg">
    </div>
  </div>
</section>



<section class="main-section tickets" id="tickets">
    <h2 class="scatterText"><?php the_field('ticket_header'); ?></h2>

    <?php if (get_field('ticket_text')): ?>
      <div class="main-section__text center"><?php the_field('ticket_text'); ?></div>
    <?php endif ?>



  <?php if (get_field('show_tickets')): ?>

    <div class="tickets__links">
      <?php get_template_part('templates/ticket_buttons') ?>
    </div>

    <div class="volunteering" id="volunteering">
      <div class="volunteering__or">Or</div>
      <div class="faq__item">

        <h3><a href="#" class="cta cta--link reveal-button volunteermodal-link">Volunteer</a></h3>

        <div class="reveal" style="display: none;">
          <?php the_field('volunteering_text') ?>
          <a class="volunteerticket-link button cta volunteer-link" href="http://buytickets.at/brainchildfestival/140274/r/website" target="_blank">Buy a Ticket</a>
        </div>
      </div>
    </div>
  <?php endif ?>

</section>

<section class="main-section" id="lineup">
  <h2 class="scatterText">Lineup</h2>
  <div class="main-section__text"><?php the_field('lineup_text'); ?></div>

  <?php // get_template_part('templates/lineup-list') ?>

  <?php if (get_field('lineup_text_2')): ?>
    <div class="main-section__text center"><?php the_field('lineup_text_2'); ?></div>
  <?php endif ?>
</section>

<?php
/*
<section class="installations main-section">
  <h2 class="scatterText">Installation Artists</h2>
  <?php if (get_field('installations_text')): ?>
    <div class="main-section__text"><?php the_field('installations_text'); ?></div>
  <?php endif ?>

    <div class="artist__grid">

    <?php
    $lineupargs = array (
      'post_type'     => 'artists',
      'orderby'       => 'publish_date',
      'posts_per_page'=> '5',
      'category_name' => '2018-lineup',
      'tag'           => 'installationartist',
      'order'         => 'ASC'
    );
    // The Query
    $lineup = new WP_Query( $lineupargs ); ?>



    <?php while ($lineup->have_posts()) : $lineup->the_post(); ?>
      <article <?php post_class(); ?> data-artist="<?php the_ID(); ?>" <?php echo ($is_track ? 'data-is_track="true"' : null) ?> >
        <a class="artist-overlay" href="<?php the_permalink(); ?>" data-mfp-src="#artist<?php the_ID(); ?>" data-artist="<?php the_ID(); ?>">
          <div class="entry-image" data-artist="<?php the_ID(); ?>">
            <?php if ( has_post_thumbnail() ) { the_post_thumbnail('lineup');} else {
              echo '<img src="' . trailingslashit( get_template_directory_uri() ) . 'dist/images/contents/default-thumbnail.png' . '" />';
            } ?>
          </div>
          <h2 data-artist="<?php the_ID(); ?>" <?php post_class('entry-title'); ?>><?php the_title(); ?></h2>
        </a>
      </article>
      <?php endwhile;?>
    </div>


    <div class="lineup-overlays">

      <?php

      // The Loop
      while ($lineup->have_posts()) : $lineup->the_post();
        get_template_part('templates/content-lineup-overlay', get_post_type() != 'post' ? get_post_type() : get_post_format());
        endwhile;?>

    </div>
    <?php wp_reset_postdata(); ?>

    <div class="see-more"><a href="/installations">Explore all the installation artists &rarr;</a></div>


</section>

*/
?>

<section class="main-section bc-words" id="bc-words">
  <h2 class="scatterText">Writing</h2>
  <div class="bc-words__posts blog-feed">
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
    <div class="see-more"><a class="bc-words-allposts" href="/blog">See all posts...  &rarr;</a></div>
</section>



<section class="main-section gallery" id="gallery">

    <?php if (get_field('festival_gallery')): ?>
      <?php the_field('festival_gallery') ?>
    <?php endif ?>

  <p class="big-txt">Photography: <a target="_blank" href="http://www.holliefernandophotography.com/">Hollie Fernando</a></p>
</section>

<section class="home__section main-section" id="faq">
  <h2>FAQ</h2>
  <div class="expandable">
    <?php the_field('faq_text') ?>
  </div>
</section>

<section class="main-section getinvolved" id="getinvolved">
  <h2 class="scatterText">Get In Touch</h2>
  <?php the_field('get_involved_text'); ?>
</section>

<footer class="main-section">
  <?php the_field('footer_text'); ?>
</footer>
