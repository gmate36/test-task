<?php

class PageSettings
{
    public static $displayFooterPostsMetaName = 'display_footer_posts';

    public static function registerActions()
    {
        $instance = new self;

        add_action('add_meta_boxes', [$instance, 'addMetaBox']);
        add_action('save_post', [$instance, 'saveMetabox'], 10, 2);
    }

    public function addMetaBox()
    {
        add_meta_box(
            self::$displayFooterPostsMetaName,
            'Display posts after footer',
            [$this, 'callbackMetabox'],
            'page',
            'normal',
        );
    }

    public function callbackMetabox($post)
    {
        $displayPosts = get_post_meta($post->ID, self::$displayFooterPostsMetaName, true);

        $checked = '';
        if ($displayPosts !== '' && $displayPosts === 'on') {
            $checked = 'checked';
        }

        echo '
            <input type="checkbox" name="' . self::$displayFooterPostsMetaName . '" ' . checked('yes', $displayPosts, false) . $checked . '/> Yes
        ';
    }

    public function saveMetabox($postID, $post)
    {
        $postType = get_post_type_object($post->post_type);
        if (!current_user_can($postType->cap->edit_post, $postID)) {
            return $postID;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $postID;
        }

        if ('page' !== $post->post_type) {
            return $postID;
        }

        if (isset($_POST[self::$displayFooterPostsMetaName])) {
            update_post_meta($postID, self::$displayFooterPostsMetaName, sanitize_text_field($_POST[self::$displayFooterPostsMetaName]));
        } else {
            delete_post_meta($postID, self::$displayFooterPostsMetaName);
        }
    }
}
