<div class="gallery gallery-theme--blocks" >
  <?php $i = 0; ?>
  <?php foreach($images as $id): $image = gt_image($id); ?>
    <?php
    $large_attributes = wp_get_attachment_image_src($id,'gallery_16_9');
    $fullwidth = $large_attributes[1];
    $fullheight = $large_attributes[2];
    $thumb_attributes = wp_get_attachment_image_src($id,'gallery_thumb_16_9');
    $thumbwidth = $thumb_attributes[1];
    $thumbheight = $thumb_attributes[2];
    $fullmeta = wp_get_attachment_metadata( $id );
    ?>

  <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" class="gallery-item">
    <a title="<?php echo esc_attr( $image['alt'] ) ?>" data-size="<?php echo esc_attr($fullwidth) ?>x<?php echo esc_attr($fullheight) ?>" href="<?php echo $large_attributes[0]; ?>" data-index="<?php echo $i; ?>">
      <img width="<?php echo esc_attr($thumbwidth) ?>" height="<?php echo esc_attr($thumbheight) ?>" <?php my_responsive_image($id, 'gallery_thumb_16_9', '800px' )  ?> alt="<?php echo $image['alt']; ?>">
    </a>
    <figcaption><?php echo $image['caption']; ?></figcaption>
  </figure>

  <?php $i++; ?>
  <?php endforeach; ?>
</div>
