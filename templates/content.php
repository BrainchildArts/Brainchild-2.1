<article <?php post_class(); ?>>
  <a href="<?php the_permalink(); ?>">
    <header>
      <div class="entry-image">
        <?php if ( has_post_thumbnail() ) {
          $id = get_post_thumbnail_id();
          echo get_responsive_attachment_image($id, 'post-feed');
        } ?>
      </div>
      <div class="entry-text">
        <h2 class="entry-title"><?php the_title(); ?></h2>
        <div class="entry-summary">
          <?php the_excerpt(); ?>
        </div>
      </div>
    </header>
  </a>
</article>
