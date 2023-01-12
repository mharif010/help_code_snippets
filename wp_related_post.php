// related post for single post page 
function showRelatedPosts($postType = 'post', $postID = null, $totalPosts = null, $relatedBy = null)
{
    global $post, $related_posts_custom_query_args;
    if (null === $postID) $postID = $post->ID;
    if (null === $totalPosts) $totalPosts = 3;
    if (null === $relatedBy) $relatedBy = 'category';
    if (null === $postType) $postType = 'post';

    // Build our basic custom query arguments

    if ($relatedBy === 'category') {
        $categories = get_the_category($post->ID);
        $catidlist = '';
        foreach ($categories as $category) {
            $catidlist .= $category->cat_ID . ",";
        }
        // Build our category based custom query arguments
        $related_posts_custom_query_args = array(
            'post_type' => $postType,
            'posts_per_page' => $totalPosts, // Number of related posts to display
            'post__not_in' => array($postID), // Ensure that the current post is not displayed
            'orderby' => 'rand', // Randomize the results
            'cat' => $catidlist, // Select posts in the same categories as the current post
        );
    }

    if ($relatedBy === 'tags') {

        // Get the tags for the current post
        $tags = wp_get_post_tags($postID);
        // If the post has tags, run the related post tag query
        if ($tags) {
            $tag_ids = array();
            foreach ($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
            // Build our tag related custom query arguments
            $related_posts_custom_query_args = array(
                'post_type' => $postType,
                'tag__in' => $tag_ids, // Select posts with related tags
                'posts_per_page' => $totalPosts, // Number of related posts to display
                'post__not_in' => array($postID), // Ensure that the current post is not displayed
                'orderby' => 'rand', // Randomize the results
            );
        } else {
            // If the post does not have tags, run the standard related posts query
            $related_posts_custom_query_args = array(
                'post_type' => $postType,
                'posts_per_page' => $totalPosts, // Number of related posts to display
                'post__not_in' => array($postID), // Ensure that the current post is not displayed
                'orderby' => 'rand', // Randomize the results
            );
        }
    }

    // Initiate the custom query
    $custom_query = new WP_Query($related_posts_custom_query_args);


    // Run the loop and output data for the results
    if ($custom_query->have_posts()) : ?>
        <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>

            <div class="col-sm-4 col-md-4">
                <div class="post-thumbnail">
                    <a href="https://www.reviano.com/blog/top-5-benefits-of-time-tracking-software.html">
                        <img src="<?php the_post_thumbnail_url('card-thumb') ?>" alt="<?php the_title() ?>" name="<?php the_title(); ?>">
                    </a>
                </div>
                <div class="entry-desc">
                    <span class="h3">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </span>
                </div>
            </div>

        <?php endwhile; ?>
    <?php else : ?>
        <p>Sorry, no related articles to display.</p>
<?php endif;
    // Reset postdata
    wp_reset_postdata();
}
