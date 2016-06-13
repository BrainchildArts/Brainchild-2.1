<?php
if(has_term('blog', 'category', $post)) {
   get_template_part('templates/content-single', 'blog');
} elseif(has_term('lineup', 'category', $post)) {
   get_template_part('templates/content-single', 'lineup');
} elseif(has_term('highlights', 'category', $post)) {
   get_template_part('templates/content-single', 'highlights');
} else {
   get_template_part('templates/content-single', get_post_type());
}
?>
