<?php

/**
 * Class Common
 *
 * Register js helpers scripts
 */

class Common
{
    public static function registerScripts(): void
    {
        $instance = new self;
        add_action('wp_enqueue_scripts', [$instance, 'enqueueScripts']);
        add_action('wp_head', [$instance, 'addingJsVariables']);
    }

    public function enqueueScripts(): void
    {
        wp_enqueue_script('test-plugin-script', plugin_dir_url(dirname(__FILE__)) . 'js/scripts.js', ['jquery'], '1.0', true);
    }

    public function addingJsVariables(): void
    {
        $params = [
            'ajax_url' => admin_url('admin-ajax.php'),
        ];
        echo
        '<script type="text/javascript">window.wp_data = ',
        json_encode($params),
        ';</script>';
    }
}
