<?php
if(has_term('blog', 'category', $post)) {
   get_template_part('single-blog', 'blog');
} else {
   // use default template file single-template.php
   get_template_part('templates/content-single', get_post_type());
}
?>
