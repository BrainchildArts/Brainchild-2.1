<?php $url = home_url();?>
<section class="outer-container">
  <div id="blog-header">
    <h1>BC Words</h1>
    <p>Brainchild's <a href="<?php echo $url; echo "/category/blog";?>">blog</a> |  <a href="<?php echo $url;?>">Festival</a> | About</p>
  </div>
    <?php if ( have_posts() ) : while( have_posts() ) : the_post();?>
        <?php the_content(); ?>
      <?php endwhile; endif; ?>
</section>
