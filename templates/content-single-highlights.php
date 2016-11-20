<?php while (have_posts()) : the_post(); ?>

  <article <?php post_class(); ?>>
    <header>
      <div class="entry-image">
        <?php if ( has_post_thumbnail() ) {
        the_post_thumbnail('large', array( 'class' => 'featured-img' ));
        }?>
      </div>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>

    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
      <div id="post-nav" class="posts">
          <?php $prevPost = get_previous_post(true);
              if($prevPost) {
                  $args = array(
                      'posts_per_page' => 1,
                      'include' => $prevPost->ID
                  );
                  $prevPost = get_posts($args);
                  foreach ($prevPost as $post) {
                      setup_postdata($post);
          ?>
                  <?php get_template_part('templates/content-highlights', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>

          <?php
                      wp_reset_postdata();
                  } //end foreach
              } // end if

              $nextPost = get_next_post(true);
              if($nextPost) {
                  $args = array(
                      'posts_per_page' => 1,
                      'include' => $nextPost->ID
                  );
                  $nextPost = get_posts($args);
                  foreach ($nextPost as $post) {
                      setup_postdata($post);
          ?>
              <?php get_template_part('templates/content-highlights', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
          <?php
                      wp_reset_postdata();
                  } //end foreach
              } // end if
          ?>
      </div>
    </footer>
  </article>

<?php endwhile; ?>
