<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
<?php endif; ?>

<section id="artist__grid">
  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/content-lineup', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
  <?php endwhile; ?>
</section>

<?php the_posts_navigation(); ?>
