<?php while (have_posts()) : the_post(); ?>

  <?php $is_link = get_field('website_link') ?>
  <?php $is_track = get_field('soundcloud_link') ?>
  <?php $is_yt = get_field('youtube_link') ?>


  <article <?php post_class(); ?>>
    <header>
      <?php if ( has_post_thumbnail() ) {
      the_post_thumbnail('grid-square', array( 'class' => 'featured-img' ));
      }?>
      <div class="header__content">
        <h1 class="entry-title"><?php the_title(); ?></h1>
      </div>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <div class="artist__links">
    <?php if ( $is_link ) { ?>
      <a target="_blank" class="website_link artist__link" href="<?php the_field('website_link') ?>">Find Out More</a>
    <?php } ?>

    <?php if ( $is_track ) { ?>
      <a target="_blank" class="soundcloud_link artist__link" href="<?php the_field('soundcloud_link') ?>">Play</a>
    <?php } ?>

    <?php if ( $is_yt ) { ?>
      <a target="_blank" class="youtube_link artist__link" href="<?php the_field('youtube_link') ?>">Video</a>
    <?php } ?>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
  </article>

  <?php get_template_part('templates/modal-youtube') ?>
  <?php get_template_part('templates/player') ?>
<?php endwhile; ?>
