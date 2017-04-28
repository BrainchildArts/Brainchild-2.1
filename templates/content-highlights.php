<?php
$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium', true);
$thumb_url = $thumb_url_array[0];
?>

<a data-featherlight="<?php the_permalink(); ?> .main-article" href="<?php the_permalink(); ?>">
  <article <?php post_class(); ?> >
    <h1 class="entry-title"><?php the_title(); ?></h1>
    <svg class="svg-button" viewBox="0 0 859.07 795.06">
      <g>

        <path id="svg-button-<?php the_id(); ?>" fill="url(#pattern-<?php the_id(); ?>)" d="M102.53,510.48,0,343.13c4.33-6.27,7.74-11.53,11.47-16.56Q40.62,287.3,69.9,248.12c7.77-10.46,11.6-22.27,14.35-35.08C95,163,106.4,113.17,125.11,65.29c4.14-10.6,9.47-19.6,19.15-25.44,18-10.9,36-22,54.54-32C214.57-.6,231.48-2.47,248.93,3.42c24.82,8.38,50.2,15.31,74.5,25,24,9.56,48.63,11.25,73.35,8.27,42.22-5.08,84.07-4.88,126.08,1.65C552.28,42.89,578.54,54,598.64,76c30.16,33,66,58.59,104.28,80.67,53.14,30.64,87.82,77,116,129.66a273.53,273.53,0,0,0,22.62,35.58c16.61,22,20.22,46.79,15.88,72.86-8.18,49.21-28.15,92.55-64.76,127.7-24,23.08-48.12,45.94-78.31,64L602.74,795.06c-73.16-3.5-142.3-31-212.87-53.74-12.31,4.13-24.86,7.16-36.4,12.4-61.41,27.85-122.23,20.9-182.68-2.57-16-6.21-31.2-14.5-43.75-20.41-21.87-30-35.35-59.16-33.8-93.45.78-17.24,2.15-34.45,3.43-51.66C98.57,560.18,100.63,534.75,102.53,510.48Z"/>
        <text x="50%" y="50%"><textpath xlink:href="#textPath" ><?php the_title(); ?></textpath></text>
      </g>

      <defs>
            <pattern id="pattern-<?php the_id(); ?>" height="100%" width="100%"
            patternContentUnits="objectBoundingBox"
            viewBox="0 0 1 1" preserveAspectRatio="xMidYMid slice">
                <image height="1" width="1" preserveAspectRatio="xMidYMid slice" xlink:href="<?php echo $thumb_url ?>" />
                <rect width="100%" height="100%" x="0" preserveAspectRatio="xMidYMid slice" fill="rgba(255,255,255,.2)"></rect>
            </pattern>
            <path id="textPath" d="M130,631 C173,121 392,312 489,23" />
        </defs>
    </svg>
  </article>
</a>



