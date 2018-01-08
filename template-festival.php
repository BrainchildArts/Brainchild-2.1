<?php
/**
 * Template Name: Festival Page
 */
?>

<section class='splash' id="splash">
  <div class='muted' id='sound'>
    <img class='black' src='<?php bloginfo('template_directory'); ?>/dist/images/partials/note.svg'>
    <img class='white' src='<?php bloginfo('template_directory'); ?>/dist/images/partials/note--white.svg'>
  </div>
  <div class="splash-content splash__frame"></div>
  <div id="video_background" class="headervideo responsive"></div>
  <div class='splash__text splash-content content'>
    <img class='logo splash-content' src='<?php bloginfo('template_directory'); ?>/dist/images/partials/bclogo.svg'>
    <h3 class='splash-content'>Festival 2018</h3>
    <h2 class='dates splash-content scatterText'>13-15 July</h2>
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
  <div class="images">
    <img class="left" src="<?php bloginfo('template_directory'); ?>/dist/images/cutouts/cutout-1.svg">
    <img class="right" src="<?php bloginfo('template_directory'); ?>/dist/images/cutouts/cutout-3.svg">
  </div>
</section>



<section class="main-section tickets" id="tickets">
    <h2 class="scatterText"><?php the_field('ticket_header'); ?></h2>

    <?php if (get_field('ticket_text')): ?>
      <div class="main-section__text center"><?php the_field('ticket_text'); ?></div>
    <?php endif ?>

    <?php if (get_field('ticket_signup')): ?>
      <div class="main-section__block">
        <!-- Begin MailChimp Signup Form -->
        <div id="ticket_signup_form" class="signup-form signup-form--blocky">

          <h2><?php the_field('ticket_signup') ?></h2>

          <form action="//brainchildfestival.us5.list-manage.com/subscribe/post?u=68b0d29fc481af44dddb8cd30&amp;id=ac61af5ccd&amp;SIGNUP=ticket_signup" method="post" id="mc-ticket-signup-form" name="mc-ticket-signup-form" class="validate" target="_blank" novalidate>
            <div class="mc-embed-flex" id="mc_embed_signup_scroll">
              <div class="mc-field-group">
                <label for="mce-ticket-signup-EMAIL">Email Address </label>
                <input type="email" value="" name="EMAIL" class="required email" id="mce-ticket-signup-EMAIL">
              </div>
              <div id="mce-ticket-signup-responses" class="clear">
                <div class="response" id="mce-ticket-signup-error-response" style="display:none"></div>
                <div class="response" id="mce-ticket-signup-success-response" style="display:none"></div>
              </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
              <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_68b0d29fc481af44dddb8cd30_ac61af5ccd" tabindex="-1" value=""></div>
              <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-ticket-signup" class="button"></div>
            </div>
          </form>
        </div>
        <!--End mc_embed_signup-->

      </div>
    <?php endif ?>

  <div class="tickets__links">

    <?php if (get_field('show_tickets')): ?>
      <?php get_template_part('templates/ticket_buttons') ?>
    <?php endif ?>

  </div>
</section>

<section class="main-section" id="lineup">
  <h2 class="scatterText">Lineup</h2>
  <div class="main-section__text"><?php the_field('lineup_text'); ?></div>

  <?php if (get_field('lineup_text_2')): ?>
    <div class="main-section__text center"><?php the_field('lineup_text_2'); ?></div>
  <?php endif ?>
</section>


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

<section class="main-section getinvolved" id="getinvolved">
  <h2 class="scatterText">Get In Touch</h2>
  <?php the_field('get_involved_text'); ?>
</section>

<footer class="main-section">
  <?php the_field('footer_text'); ?>
</footer>
