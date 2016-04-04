<?php $thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
$thumb_url = $thumb_url_array[0]; ?>

<article <?php post_class(); ?>>
  <a href="<?php the_permalink(); ?>"
  data-largesrc="<?php echo $thumb_url ?>"
  data-title="<?php the_title() ?>"
  data-description="<?php the_content()?>">
    <div class="entry-image">
      <?php if ( has_post_thumbnail() ) { the_post_thumbnail('grid-square');} ?>
      <div class="entry-image__overlay"></div>
      <h2 class="entry-title"><?php the_title(); ?></h2>
    </div>
  </a>
</article>
