<!-- <ul class="filter-tabs">
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
    <a class="filter" onclick="return false;" href="#" data-filter="tag-film">Film</a>
  </li>
  <li>
    <a class="filter" onclick="return false;" href="#" data-filter="tag-talksworkshops">Talks &amp; Workshops</a>
  </li>
  <li>
    <a class="filter" onclick="return false;" href="#" data-filter="tag-comedy">Comedy</a>
  </li>
</ul> -->

<div class="artist__grid">

<?php
$lineupargs = array (
  'post_type'     => 'artists',
  'nopaging'      => true,
  'orderby'       => 'name',
  'tag__not_in' => array( 63 ),
  'category_name' => '2018-lineup',
  'order'         => 'ASC'
);
// The Query
$lineup = new WP_Query( $lineupargs );


while ($lineup->have_posts()) : $lineup->the_post(); ?>
  <div class="entry-image" data-artist="<?php the_ID(); ?>">
    <?php if ( has_post_thumbnail() ) { the_post_thumbnail('lineup-list');} else {
      echo '<img src="' . trailingslashit( get_template_directory_uri() ) . 'dist/images/contents/default-thumbnail.png' . '" alt="" />';
    } ?>
  </div>
<?php endwhile;?>


<?php while ($lineup->have_posts()) : $lineup->the_post(); ?>
  <h2 data-artist="<?php the_ID(); ?>" <?php post_class('entry-title'); ?>><a class="artist-overlay" href="<?php the_permalink(); ?>" data-mfp-src="#artist<?php the_ID(); ?>" data-artist="<?php the_ID(); ?>"><?php the_title(); ?></a></h2>
  <?php endwhile;?>
</div>

<div class="lineup-overlays">

  <?php
  $lineupargs = array (
    'post_type'     => 'artists',
    'nopaging'      => true,
    'orderby'       => 'name',
    'tag__not_in'   => array( 63 ),
    'category_name' => '2018-lineup',
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
