<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <img id="featured-img" src=<?php if ( has_post_thumbnail() ) { the_post_thumbnail();}?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
  </article>
<?php endwhile; ?>




<?php $url = home_url();?>
<?php
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); { ?>

      <?php if ( has_post_thumbnail() ) {
      the_post_thumbnail(array( 'class' => 'featured-img' ));
      }?>

      <img id="featured-img" src=<?php if ( has_post_thumbnail() ) { the_post_thumbnail();}?>>
      <section class="outer-container">
			<div class="blog-post blog-post-back">
        <br>
        <p><em><?php the_date();?></em> | <em> <?php the_author();?></em></p>
				<blockquote><p><?php the_title(); ?></p></blockquote>
        <p><?php the_content(); ?></p>
				</a>
			</div>
		<?php }
	}
} else {
	// no posts found
}

// Restore original Post Data
wp_reset_postdata();?>
</section>
<section class="outer-container">
<div id="blog-loop">
<?php
//Start recent post loop

// WP_Query arguments

$id = (get_the_id());

$args = array (
	'category_name'          => 'blog',
  'post__not_in'           => array($post->ID),
  'posts_per_page'         => '2',
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post(); { ?>
			<div class="blog-post blog-post-front">
				<a href="<?php the_permalink(); ?>">
				<img src=<?php if ( has_post_thumbnail() ) { the_post_thumbnail();} ?>
				<h1><?php the_title(); ?></h1>
				<p><?php the_excerpt(); ?></p>
				</a>
			</div>
		<?php }
	}
} else {
	// no posts found
}

// Restore original Post Data
wp_reset_postdata();
?>
</div>
</section>
