<?php $is_link = get_field('website_link') ?>
<?php $is_track = get_field('soundcloud_link') ?>
<?php $is_yt = get_field('youtube_link') ?>

 <?php $posttags = get_the_tags(); ?>

<article <?php post_class(); ?> data-artist="<?php the_ID(); ?>" <?php echo ($is_track ? 'data-is_track="true"' : null) ?> >
    <div class="artist__content" id="artist<?php the_ID(); ?>">
      <div class="lightbox__close"><span>close</span></div>

      <div class="entry-image" data-artist="<?php the_ID(); ?>">
        <?php if ( has_post_thumbnail() ) {
           $class = 'lazyload attachment-lineup size-lineup ';

           //Get thumbnail source
           $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'lineup');
           $src = $thumb['0'];
           $width = $thumb['1'];
           $height = $thumb['2'];

           $placeholder = "data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=";

           echo '<img src="'.$placeholder.'" data-src="'.$src.'" class="'.$class.'" width="'.$width.'" height="'.$height.'"/>';

        } else {
          echo '<img src="' . trailingslashit( get_template_directory_uri() ) . 'dist/images/contents/default-thumbnail.png' . '" alt="" />';
        } ?>
      </div>

      <?php if ($posttags) {
        echo '<div class="artist__tags">';
        foreach($posttags as $tag) {
          echo '<span>' .$tag->name. '</span>';
        }
        echo '</div>';
      }
      ?>
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


