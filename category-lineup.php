<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
<?php endif; ?>

<ul class="filter-tabs">
  <li>
    <a class="button filter is-checked all" onclick="return false;" href="#" data-filter="all">All</a>
  </li>
  <li>
    <a class="button filter tag-music" onclick="return false;" href="#" data-filter="tag-music">Music</a>
  </li>
  <li>
    <a class="button filter tag-poetry" onclick="return false;" href="#" data-filter="tag-poetry, .tag-theatre">Theatre &amp; Spoken Word</a>
  </li>
  <li>
    <a class="button filter tag-film" onclick="return false;" href="#" data-filter="tag-film">Film</a>
  </li>
  <li>
    <a class="button filter tag-talks" onclick="return false;" href="#" data-filter="tag-talks, .tag-workshops">Talks &amp; Workshops</a>
  </li>
  <li>
    <a class="button filter tag-art" onclick="return false;" href="#" data-filter="tag-art">Art</a>
  </li>
</ul>
<section id="artist__grid">
  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/content-lineup', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
  <?php endwhile; ?>
</section>

<?php the_posts_navigation(); ?>
