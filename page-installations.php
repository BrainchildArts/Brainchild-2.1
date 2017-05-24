<h2 class="scatterText">Installation Artists</h2>

<div class="the_content">
  <?php the_content(); ?>
</div>


<section class="installations">

  <div class="artist__grid">

  <?php
  $lineupargs = array (
    'post_type'     => 'artists',
    'nopaging'      => true,
    'orderby'       => 'name',
    'tag'           => 'installationartist',
    'order'         => 'ASC'
  );
  // The Query
  $lineup = new WP_Query( $lineupargs ); ?>



  <?php while ($lineup->have_posts()) : $lineup->the_post(); ?>
    <article <?php post_class(); ?> data-artist="<?php the_ID(); ?>" <?php echo ($is_track ? 'data-is_track="true"' : null) ?> >
      <a class="artist-overlay" href="<?php the_permalink(); ?>" data-mfp-src="#artist<?php the_ID(); ?>" data-artist="<?php the_ID(); ?>">
        <div class="entry-image" data-artist="<?php the_ID(); ?>">
          <?php if ( has_post_thumbnail() ) { the_post_thumbnail('lineup');} else {
            echo '<img src="' . trailingslashit( get_template_directory_uri() ) . 'dist/images/contents/default-thumbnail.png' . '" />';
          } ?>
        </div>
        <h2 data-artist="<?php the_ID(); ?>" <?php post_class('entry-title'); ?>><?php the_title(); ?></h2>
      </a>
    </article>
    <?php endwhile;?>
  </div>


  <div class="lineup-overlays">

    <?php
    $lineupargs = array (
      'post_type'     => 'artists',
      'nopaging'      => true,
      'orderby'       => 'name',
      'tag'           => 'installationartist',
      'order'         => 'ASC'
    );
    // The Query
    $lineup = new WP_Query( $lineupargs );

    // The Loop
    while ($lineup->have_posts()) : $lineup->the_post();
      get_template_part('templates/content-lineup', get_post_type() != 'post' ? get_post_type() : get_post_format());
      endwhile;?>

  </div>
  <?php wp_reset_postdata(); ?>

</section>

<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>

