<a href="<?php the_permalink(); ?>">
  <article <?php post_class(); ?> >
      <header>
        <div class="entry-image">
          <?php if ( has_post_thumbnail() ) { the_post_thumbnail('large-3-2');} else {
            echo '<img src="' . trailingslashit( get_template_directory_uri() ) . 'dist/images/contents/default-thumbnail.png' . '" alt="" />';
          } ?>
        <div class="entry-image__overlay"></div>
        </div>
        <h1 class="entry-title"><?php the_title(); ?></h1>
      </header>
  </article>
</a>
