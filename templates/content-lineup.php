<?php $thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
$thumb_url = $thumb_url_array[0]; ?>

<?php $is_link = get_field('website_link') ?>
<?php $is_track = get_field('soundcloud_link') ?>
<?php $is_yt = get_field('youtube_link') ?>

<article <?php post_class(); ?>>
  <a href="<?php the_permalink(); ?>"
  data-largesrc="<?php echo $thumb_url; ?>"
  data-title="<?php the_title(); ?>"
  data-link="<?php $is_link ? the_field('website_link') : null; ?>"
  data-track="<?php $is_track ? the_field('soundcloud_link') : null; ?>"
  data-youtube="<?php $is_yt ? the_field('youtube_link') : null; ?>"
  data-description="<?php the_content(); ?>">
    <div class="entry-image">
      <?php if ( has_post_thumbnail() ) { the_post_thumbnail('grid-square');} ?>
      <div class="entry-image__overlay"></div>
      <h2 class="entry-title"><?php the_title(); ?></h2>
    </div>
  </a>
</article>
