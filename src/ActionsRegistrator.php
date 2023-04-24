<?php
/**
 * Class ActionsRegistrator
 *
 * Register all plugin hooks
 */

class ActionsRegistrator
{
    public static function registerActions()
    {
        PageSettings::registerActions();
        PostAPI::registerActions();

        $instance = new self;
        add_action('wp', [$instance, 'isPostsNeedToShow']);
    }

    public function isPostsNeedToShow()
    {
        if (get_post_meta(get_the_ID(), PageSettings::$displayFooterPostsMetaName, true) === 'on') {
            Common::registerScripts();
        }
    }
}

ActionsRegistrator::registerActions();