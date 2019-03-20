<div class="gallery gallery-theme--default" >
  <?php $i = 0; ?>
  <?php foreach($images as $id): $image = gt_image($id); ?>
    <?php
    $large_attributes = wp_get_attachment_image_src($id,'gallery_image');
    $fullwidth = $large_attributes[1];
    $fullheight = $large_attributes[2];
    $thumb_attributes = wp_get_attachment_image_src($id,'gallery_thumb');
    $thumbwidth = $thumb_attributes[1];
    $thumbheight = $thumb_attributes[2];
    $fullmeta = wp_get_attachment_metadata( $id );
    ?>

  <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" class="gallery-item">
    <a title="<?php echo esc_attr( $image['title'] ) ?>" data-size="<?php echo esc_attr($fullwidth) ?>x<?php echo esc_attr($fullheight) ?>" href="<?php echo $large_attributes[0]; ?>" data-index="<?php echo $i; ?>">
      <?php echo get_responsive_attachment_image($id, 'slider'); ?>
    </a>
    <figcaption><?php echo $image['caption']; ?></figcaption>
  </figure>

  <?php $i++; ?>
  <?php endforeach; ?>
</div>


<?php
//// Codes you can use in your gallery theme files (inside the loop):
/*
<?php echo $image['thumb']; ?> --- getting thumbnail url of the image
<?php echo $image['medium']; ?> --- getting medium-size url of the image
<?php echo $image['large']; ?> --- getting large-size url of the image
<?php echo $image['full']; ?> --- getting full-size url of the image
<?php echo $image['width']; ?> --- getting full-size image width
<?php echo $image['height']; ?> --- getting full-size image height
<?php echo $image['link']; ?> --- getting image page link
<?php echo $image['title']; ?> --- getting image title
<?php echo $image['caption']; ?> --- getting image caption
<?php echo $image['alt']; ?> --- getting image alternative text
<?php echo $image['description']; ?> --- getting image description
*/
//// Codes to get gallery settings:
/*
<?php echo $settings['link']; ?> --- getting link value from gallery settings
<?php echo $settings['columns']; ?> --- getting columns value from gallery settings
<?php echo $settings['orderby']; ?> --- getting sorting type from gallery settings
*/
?>
