<div class='muted' id='sound'>
  <img class='black' src='<?php bloginfo('template_directory'); ?>/dist/images/partials/note.svg'>
  <img class='white' src='<?php bloginfo('template_directory'); ?>/dist/images/partials/note--white.svg'>
</div>
<section class='splash'>
  <div class="splash-content splash__frame"></div>
  <video id="video_background" class="headervideo responsive" preload="auto" autoplay="autoplay" muted="true" loop="loop" poster="<?php bloginfo('template_directory'); ?>/dist/images/background/video-poster.jpg">
    <source src="https://github.com/BrainchildArts/bc-launchpage/raw/gh-pages/build/assets/images/bcfinal.mp4" type="video/mp4">
  </video>
  <div class='splash__text splash-content content'>
    <img class='logo splash-content' src='<?php bloginfo('template_directory'); ?>/dist/images/partials/bclogo.png'>
    <h3 class='splash-content'>Festival 2016</h3>
    <h2 class='dates splash-content'>8-10 July</h2>
    <h2 class='location splash-content'>East Sussex</h2>
  </div>
</section>
<div class="social">
  <ul class='social__links splash-content'>
    <li class='social__icon splash__content'>
      <a class='social__facebook' href='https://www.facebook.com/BrainchildArts' target='_blank'>
        <img class='splash__content splash-content' src='<?php bloginfo('template_directory'); ?>/dist/images/social/facebook.svg'>
      </a>
    </li>
    <li class='social__icon splash__content'>
      <a class='social__twitter' href='https://twitter.com/BrainchildFest' target='_blank' title='@brainchildfest'>
        <img class='splash__content splash-content' src='<?php bloginfo('template_directory'); ?>/dist/images/social/twitter.svg'>
      </a>
    </li>
    <li class='email splash__content'>
      <div class='modal email-modal'>
        <label for='modal-1'>
          <a class='modal-trigger' target='_blank'>Keep in Touch</a>
        </label>
        <input class='modal-state' id='modal-1' type='checkbox'>
        <div class='modal-fade-screen'>
          <div class='modal-inner'>
            <div class='modal-close' for='modal-1'></div>
            <!-- Begin MailChimp Signup Form -->
            <div id="mc_embed_signup">
            <form action="//brainchildfestival.us5.list-manage.com/subscribe/post?u=68b0d29fc481af44dddb8cd30&amp;id=0797da504b" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
              <div id="mc_embed_signup_scroll">
                <div class="mc-field-group">
                  <label for="mce-EMAIL">Email Address </label>
                  <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                </div>
                <div class="mc-field-group">
                  <label for="mce-FNAME">First Name </label>
                  <input type="text" value="" name="FNAME" class="" id="mce-FNAME">
                </div>
                <div class="mc-field-group">
                  <label for="mce-LNAME">Last Name </label>
                  <input type="text" value="" name="LNAME" class="" id="mce-LNAME">
                </div>
                  <div id="mce-responses" class="clear">
                    <div class="response" id="mce-error-response" style="display:none"></div>
                    <div class="response" id="mce-success-response" style="display:none"></div>
                  </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;"><input type="text" name="b_68b0d29fc481af44dddb8cd30_0797da504b" tabindex="-1" value=""></div>
                    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                </div>
              </form>
            </div>
            <!--End mc_embed_signup-->
          </div>
        </div>
      </div>
    </li>
  </ul>
</div>
<!-- Splash Section -->
<section class="home__section" id="about">
  <div id="manifesto">
    <p><?php the_field('welcome_text'); ?></p>
  </div>

</section>
<section class="home__section" id="tickets">
  <h1><?php the_field('ticket_header'); ?></h1>
  <a target="_blank" href="http://buytickets.at/brainchildfestival/43686/r/website" class="cta button">£55 Early Bird</a>
  <div class="upcoming">
    <button class="future-tier" disabled="true">£60 Tier 2</button>
    <button class="future-tier" disabled="true">£65 Tier 3</button>
    <button class="future-tier" disabled="true">£70 Tier 4</button>
    <button class="future-tier" disabled="true">£75 Tier 5</button>
    <button class="future-tier" disabled="true">£80 Tier 6</button>
  </div>
<!--   <div class="reveal" style="display:none;">
    <p><php the_field('ticket_text'); ?></p>
  </div> -->
</section>
<section class="home__section" id="lineup">
  <p><?php the_field('lineup_text'); ?></p>
  <div class="lineup-posters">
    <div class="bc2015">
      <h3>2015</h3>
      <a href="<?php bloginfo('template_directory'); ?>/dist/images/contents/bc2015.png" class="zoom-in">
        <img src="<?php bloginfo('template_directory'); ?>/dist/images/contents/bc2015.png" alt="Brainchild 2015 Poster">
      </a>
    </div>
    <div class="bc2013">
      <h3>2013</h3>
      <a href="<?php bloginfo('template_directory'); ?>/dist/images/contents/bc13front.png" class="zoom-in">
        <img src="<?php bloginfo('template_directory'); ?>/dist/images/contents/bc13front.png" alt="Brainchild 2013 Poster">
      </a>
      <a href="<?php bloginfo('template_directory'); ?>/dist/images/contents/bc13back.png" class="zoom-in">
        <img src="<?php bloginfo('template_directory'); ?>/dist/images/contents/bc13back.png" alt="Brainchild 2013 Poster">
      </a>
    </div>
  </div>
</section>

<section class="home__section" id="bc-words">
  <?php the_field('words_text'); ?>
</section>

<section class="home__section gallery" id="gallery">
  <div class="slide slide-1">
  <?php
  if ( get_post_gallery() ) {

      $gallery        = get_post_gallery( get_the_ID(), false );
      $galleryIDS     = $gallery['ids'];
      $pieces         = explode(",", $galleryIDS);

      foreach ($pieces as $key => $value ) {

          $image_large   = wp_get_attachment_image_src( $value, 'large');
          $image_full     = wp_get_attachment_image_src( $value, 'full');
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

<section class="home__section" id="faq">
  <h2>FAQ</h2>
  <div class="expandable">
  <?php the_field('faq_text') ?>
  </div>
</section>

<section class="home__section getinvolved" id="getinvolved">
  <h2>Get In Touch</h2>
  <?php the_field('get_involved_text'); ?>
</section>
<footer>
  <?php the_field('footer_text'); ?>
</footer>
<?php the_posts_navigation(); ?>
