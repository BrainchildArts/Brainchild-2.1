<?php $url = home_url();?>
<section class="outer-container">
	<section class="outer-container">
	  <div id="blog-header">
	    <h1>Blog Posts</h1>
	  </div>
	</section>
	<div id="blog-loop">
<?php
// WP_Query arguments
$args = array (
	'category_name'          => 'blog',
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post(); { ?>
			<div class="blog-post blog-post-front">
				<a href="<?php the_permalink(); ?>">
          <div class="blog-post-front__image">
            <?php if ( has_post_thumbnail() ) { the_post_thumbnail();} ?>
          </div>
          <div class="blog-post-front__text">
            <h1><?php the_title(); ?></h1>
            <p><?php the_excerpt(); ?></p>
          </div>
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
