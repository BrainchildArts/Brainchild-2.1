<?php
$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium', true);
$thumb_url = $thumb_url_array[0]; ?>

<?php $is_link = get_field('website_link') ?>
<?php $is_track = get_field('soundcloud_link') ?>
<?php $is_yt = get_field('youtube_link') ?>

<article <?php post_class(); ?> data-mfp-src="#artist<?php the_ID(); ?>" <?php echo ($is_track ? 'data-is_track' : null) ?> id="artist<?php the_ID(); ?>" >
  <a href="<?php the_permalink(); ?>"
  data-link="<?php echo $is_link ? get_field('website_link') : null; ?>"
  data-track="<?php echo $is_track ? get_field('soundcloud_link') : null; ?>"
  data-youtube="<?php echo $is_yt ? get_field('youtube_link') : null; ?>"
  >
    <div class="entry-image">
      <?php if ( has_post_thumbnail() ) { the_post_thumbnail('lineup');} else {
        echo '<img src="' . trailingslashit( get_template_directory_uri() ) . 'dist/images/contents/default-thumbnail.png' . '" alt="" />';
      } ?>
      <div class="entry-image__overlay"></div>
      <h2 class="entry-title"><?php the_title(); ?></h2>
    </div>
  </a>
  <div class="entry-content">
    <?php the_content(); ?>
  </div>
  <div class="artist__links">
    <?php if ( $is_link ) { ?>
    <a target="_blank" class="website_link artist__link" href="<?php the_field('website_link') ?>">Find Out More</a>
    <?php } ?>

    <?php if ( $is_track ) { ?>
    <a target="_blank" class="soundcloud_link artist__link" href="<?php the_field('soundcloud_link') ?>">Play</a>
    <?php } ?>

    <?php if ( $is_yt ) { ?>
    <a target="_blank" class="youtube_link artist__link" href="<?php the_field('youtube_link') ?>">Video</a>
    <?php } ?>
  </div>
</article>


