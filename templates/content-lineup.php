<?php
$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium', true);
$thumb_url = $thumb_url_array[0]; ?>

<?php $is_link = get_field('website_link') ?>
<?php $is_track = get_field('soundcloud_link') ?>
<?php $is_yt = get_field('youtube_link') ?>

<article <?php post_class(); ?> <?php echo ($is_track ? 'data-is_track' : null) ?> >
  <a href="<?php the_permalink(); ?>"
  data-largesrc="<?php echo $thumb_url; ?>"
  data-title="<?php the_title(); ?>"
  data-link="<?php $is_link ? the_field('website_link') : null; ?>"
  data-track="<?php $is_track ? the_field('soundcloud_link') : null; ?>"
  data-youtube="<?php $is_yt ? the_field('youtube_link') : null; ?>"
  data-description="<?php esc_html_e(get_the_content()); ?>">
    <div class="entry-image">
      <?php if ( has_post_thumbnail() ) { the_post_thumbnail('medium');} else {
        echo '<img src="' . trailingslashit( get_template_directory_uri() ) . 'dist/images/contents/default-thumbnail.png' . '" alt="" />';
      } ?>
      <div class="entry-image__overlay"></div>
      <h2 class="entry-title"><?php the_title(); ?></h2>
    </div>
  </a>
</article>
