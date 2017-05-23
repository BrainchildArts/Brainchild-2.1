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
    <a class="filter" onclick="return false;" href="#" data-filter="tag-film">Film</a>
  </li>
  <li>
    <a class="filter" onclick="return false;" href="#" data-filter="tag-talksworkshops">Talks &amp; Workshops</a>
  </li>
<!--   <li>
    <a class="filter" onclick="return false;" href="#" data-filter="tag-art">Art</a>
  </li> -->
</ul>

<div class="artist__grid">

<?php
$lineupargs = array (
  'post_type'     => 'artists',
  'nopaging'      => true,
  'orderby'       => 'name',
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
  <h2 data-artist="<?php the_ID(); ?>" <?php post_class('entry-title'); ?>><a href="<?php the_permalink(); ?>" data-mfp-src="#artist<?php the_ID(); ?>" data-artist="<?php the_ID(); ?>"><?php the_title(); ?></a></h2>
  <?php endwhile;?>
</div>
