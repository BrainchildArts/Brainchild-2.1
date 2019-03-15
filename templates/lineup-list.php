<ul class="filter-tabs">
  <li class="active">
    <a class="filter" onclick="return false;" href="#" data-filter="all">All</a>
  </li>
  <li>
    <a class="filter" onclick="return false;" href="#" data-filter="tag-music">Music</a>
  </li>
  <li>
    <a class="filter" onclick="return false;" href="#" data-filter="tag-poetrytheatre">Theatre &amp; Spoken Word</a>
  </li>
  <li>
    <a class="filter" onclick="return false;" href="#" data-filter="tag-talksworkshopsfilm">Talks &amp; Workshops</a>
  </li>
  <li>
    <a class="filter" onclick="return false;" href="#" data-filter="tag-comedy">Comedy</a>
  </li>
</ul>

<div class="artist__grid">


<?php
$lineupallargs = array (
  'post_type'     => 'artists',
  'nopaging'      => true,
  'orderby'       => 'name',
  'tag__not_in' => array( 63 ),
  'category_name' => '2018-lineup',
  'order'         => 'ASC'
);
// The Query
$lineupall = new WP_Query( $lineupallargs );


while ($lineupall->have_posts()) : $lineupall->the_post(); ?>
  <div class="entry-image" data-artist="<?php the_ID(); ?>">
    <?php if ( has_post_thumbnail() ) {
       $class = 'lazyload attachment-lineup-list size-lineup-list';

       //Get thumbnail source
       $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'lineup-list');
       $src = $thumb['0'];
       $width = $thumb['1'];
       $height = $thumb['2'];

       $placeholder = "data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=";

       echo '<img src="'.$placeholder.'" data-src="'.$src.'" class="'.$class.'" width="'.$width.'" height="'.$height.'"/>';

    } else {
      echo '<img src="' . trailingslashit( get_template_directory_uri() ) . 'dist/images/contents/default-thumbnail.png' . '" alt="" />';
    } ?>
  </div>
<?php endwhile;?>



  <?php

  // Featured Artists
  $featuredargs = array (
    'post_type'     => 'artists',
    'nopaging'      => true,
    'meta_key'      => 'featured_order',
    'orderby'     => 'meta_value_num',
    'order'         => 'ASC',
    'tag__not_in' => array( 63 ),
    'category_name' => '2018-lineup',
    'meta_query' => array(
      array(
        'key' => 'featured_artist',
        'value'     => '1',
        'compare'   => '=',
      )
    ),
  );
  // The Query
  $featured = new WP_Query( $featuredargs );

if ($featured->have_posts()) { ?>
  <div class="lineup-featured">
    <?php while ($featured->have_posts()) : $featured->the_post(); ?>
      <h2 data-artist="<?php the_ID(); ?>" <?php post_class('entry-title'); ?>><a class="artist-overlay" href="<?php the_permalink(); ?>" data-mfp-src="#artist<?php the_ID(); ?>" data-artist="<?php the_ID(); ?>"><?php the_title(); ?></a></h2>
    <?php endwhile;?>
  </div>

<?php } ?>


<?php
$lineupargs = array (
  'post_type'     => 'artists',
  'nopaging'      => true,
  'orderby'       => 'name',
  'tag__not_in' => array( 63 ),
  'category_name' => '2018-lineup',
  'order'         => 'ASC',
  'meta_query'  => array(
    'relation' => 'OR',
    array(
        'key'     => 'featured_artist',
        'compare' => 'NOT EXISTS',
    ),
    array(
        'key'     => 'featured_artist',
        'value'   => '1',
        'compare' => '!=',
    ),
  ),
);
// The Query
$lineup = new WP_Query( $lineupargs ); ?>

<?php while ($lineup->have_posts()) : $lineup->the_post(); ?>
  <h2 data-artist="<?php the_ID(); ?>" <?php post_class('entry-title'); ?>><a class="artist-overlay" href="<?php the_permalink(); ?>" data-mfp-src="#artist<?php the_ID(); ?>" data-artist="<?php the_ID(); ?>"><?php the_title(); ?></a></h2>
  <?php endwhile;?>
</div>

<div class="lineup-overlays">

  <?php

  // The Loop
  while ($lineupall->have_posts()) : $lineupall->the_post();
    get_template_part('templates/content-lineup-overlay', get_post_type() != 'post' ? get_post_type() : get_post_format());
    endwhile;?>

</div>
<?php wp_reset_postdata(); ?>
