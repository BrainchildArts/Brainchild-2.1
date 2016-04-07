<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
<?php endif; ?>

<section id="lineup">
  <?php get_template_part('templates/lineup') ?>
</section>

<?php the_posts_navigation(); ?>
