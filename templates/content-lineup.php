<?php $is_link = get_field('website_link') ?>
<?php $is_track = get_field('soundcloud_link') ?>
<?php $is_yt = get_field('youtube_link') ?>

<article <?php post_class(); ?> data-mfp-src="#artist<?php the_ID(); ?>" <?php echo ($is_track ? 'data-is_track' : null) ?> >
    <div class="artist__content" id="artist<?php the_ID(); ?>">
      <div class="artist__close"><span>close</span></div>
      <div class="entry-image">
        <?php if ( has_post_thumbnail() ) { the_post_thumbnail('lineup');} else {
          echo '<img src="' . trailingslashit( get_template_directory_uri() ) . 'dist/images/contents/default-thumbnail.png' . '" alt="" />';
        } ?>
      </div>
      <h2 class="entry-title"><?php the_title(); ?></h2>
      <div class="artist__links">
        <?php if ( $is_link ) { ?>
        <a target="_blank" class="website_link artist__link" href="<?php the_field('website_link') ?>">Website</a>
        <?php } ?>

        <?php if ( $is_track ) { ?>
        <a target="_blank" class="soundcloud_link artist__link" href="<?php the_field('soundcloud_link') ?>">Play</a>
        <?php } ?>

        <?php if ( $is_yt ) { ?>
        <a target="_blank" class="youtube_link artist__link" href="<?php the_field('youtube_link') ?>">Video</a>
        <?php } ?>
      </div>
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
    </div>
</article>


