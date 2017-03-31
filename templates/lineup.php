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

<div id="artist__grid">

<?php
$lineupargs = array (
  'post_type'     => 'artists',
  'nopaging'      => true,
  'orderby'       => 'name',
  'order'         => 'ASC'
);
// The Query
$lineup = new WP_Query( $lineupargs );

// The Loop
while ($lineup->have_posts()) : $lineup->the_post();
  get_template_part('templates/content-lineup', get_post_type() != 'post' ? get_post_type() : get_post_format());
  endwhile;?>
</div>
