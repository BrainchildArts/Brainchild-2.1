<div class="gallery gallery-theme--blocks" >
  <?php $i = 0; ?>
  <?php foreach($images as $id): $image = gt_image($id); ?>
    <?php
    $large_attributes = wp_get_attachment_image_src($id,'gallery');
    $fullwidth = $large_attributes[1];
    $fullheight = $large_attributes[2];
    $thumb_attributes = wp_get_attachment_image_src($id,'gallery_thumb');
    $thumbwidth = $thumb_attributes[1];
    $thumbheight = $thumb_attributes[2];
    $fullmeta = wp_get_attachment_metadata( $id );
    ?>

  <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" class="gallery-item">
    <a title="<?php echo esc_attr( $image['alt'] ) ?>" data-size="<?php echo esc_attr($fullwidth) ?>x<?php echo esc_attr($fullheight) ?>" href="<?php echo $large_attributes[0]; ?>" data-index="<?php echo $i; ?>">
      <?php echo get_responsive_attachment_image($id, 'gallery_thumb'); ?>
    </a>
    <figcaption><?php echo $image['caption']; ?></figcaption>
  </figure>

  <?php $i++; ?>
  <?php endforeach; ?>
</div>
