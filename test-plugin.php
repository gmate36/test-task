<?php
/**
 * Plugin Name: test-plugin
 * Plugin URI: https://www.test-task.test/
 * Description: Test.
 * Version: 0.1
 * Author: Andrei Barbashin
 * Author URI: https://test-task.tests/
 **/

if (!defined('ABSPATH')) {
    die();
}

add_action('init', function () {
    require_once __DIR__ . '/src/Common.php';
    require_once __DIR__ . '/src/PostAPI.php';
    require_once __DIR__ . '/src/PageSettings.php';
    require_once __DIR__ . '/src/ActionsRegistrator.php';
});
