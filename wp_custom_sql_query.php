<?php 

global $wpdb;

$query = "SELECT *, rel.meta_key as user, posts.ID as course_id 
FROM wp_posts AS posts 
LEFT JOIN wp_postmeta AS rel ON posts.ID = rel.post_id 
WHERE posts.post_type = 'course' 
AND rel.meta_key   = $user_id
AND posts.post_status = 'publish' 
AND rel.meta_key REGEXP '^[0-9]+$' 
ORDER BY course_id DESC";


$pageposts = $wpdb->get_results($query);

if ($pageposts): 

foreach ($pageposts as $post): 
   setup_postdata($post);
?>
 <div class="post" id="post-<?php the_ID(); ?>">
      <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
      <?php the_title(); ?></a></h2>
      <small><?php the_time('F jS, Y') ?> </small>
      <div class="entry">
         <?php the_content('Read the rest of this entry »'); ?>
      </div>
  
      <p class="postmetadata">Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  
      <?php comments_popup_link('No Comments »', '1 Comment »', '% Comments »'); ?></p>
    </div> 

<?php 
endforeach;

else : 
    <h2 class="center">Not Found</h2>
    <p class="center">Sorry, but you are looking for something that isn't here.</p>
<?php 
endif; 
