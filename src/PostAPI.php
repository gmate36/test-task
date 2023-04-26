<?php
/**
 * Class PostAPI
 *
 * Returns 3 latest posts content via api call
 */

class PostAPI
{
    public static function registerActions(): void
    {
        $instance = new self;

        add_action('wp_ajax_get_latest_posts_content', [$instance, 'getLatestPostsContent']);
        add_action('wp_ajax_nopriv_get_latest_posts_content', [$instance, 'getLatestPostsContent']);
    }

    public function getLatestPostsContent(): void
    {
        $postsQuery = new WP_Query([
            'post_type' => 'post',
            'order' => 'ASC',
            'orderby' => 'date',
            'posts_per_page' => 3,
        ]);

        $result = [];

        while ($postsQuery->have_posts()) {
            $postsQuery->the_post();
            $result[] = get_the_content();
        }
        wp_reset_postdata();

        wp_send_json($result);
    }
}
