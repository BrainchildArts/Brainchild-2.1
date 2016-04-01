<article <?php post_class(); ?>>
  <a href="<?php the_permalink(); ?>" data-largesrc="images/2.jpg" data-title="Veggies sunt bona vobis" data-description="Komatsuna prairie turnip wattle seed artichoke mustard horseradish taro rutabaga ricebean carrot black-eyed pea turnip greens beetroot yarrow watercress kombu.">
    <div class="entry-image">
      <?php if ( has_post_thumbnail() ) { the_post_thumbnail('grid-square');} ?>
      <h2 class="entry-title"><?php the_title(); ?></h2>
    </div>
  </a>

  <div class="artist__expander" style="display: none">
    <div class="artist__expander-inner">
      <span class="artist__close"></span>
      <div class="artist__fullimg">
        <div class="artist__loading"></div>
        <?php if ( has_post_thumbnail() ) { the_post_thumbnail('grid-square');} ?>
      </div>
      <div class="entry-text artist__details">
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
        <a href="http://cargocollective.com/jaimemartinez/">Visit website</a>
      </div>
    </div>
  </div>
</article>
