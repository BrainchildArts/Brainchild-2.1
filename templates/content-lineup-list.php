<article <?php post_class(); ?> data-artist="<?php the_ID(); ?>" data-mfp-src="#artist<?php the_ID(); ?>" >
  <div class="entry-image" data-artist="<?php the_ID(); ?>">
    <?php if ( has_post_thumbnail() ) { the_post_thumbnail('lineup-list');} else {
      echo '<img src="' . trailingslashit( get_template_directory_uri() ) . 'dist/images/contents/default-thumbnail.png' . '" alt="" />';
    } ?>
  </div>
  <h2 class="entry-title"><a href="<?php the_permalink(); ?>" data-artist="<?php the_ID(); ?>"><?php the_title(); ?></a></h2>
</article>
