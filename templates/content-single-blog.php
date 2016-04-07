<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <?php if ( has_post_thumbnail() ) {
      the_post_thumbnail('large', array( 'class' => 'featured-img' ));
      }?>
      <div class="header__content">
        <?php get_template_part('templates/entry-meta'); ?>
        <h1 class="entry-title"><?php the_title(); ?></h1>
      </div>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
  </article>
<?php endwhile; ?>