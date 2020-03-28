<?php
/**
 * JSONCreateUserAPI
 *
 *
 * @package   JSONCreateUserAPI
 * @author    Dennis Acker
 * @license   GPL-3.0
 * @link      https://lucksmith.de
 * @copyright 2020 Dennis Acker Consulting
 *
 * @wordpress-plugin
 * Plugin Name:       JSONCreateUserAPI
 * Plugin URI:        https://lucksmith.de
 * Description:       Simple JSON API for Wordpress to create Users
 * Version:           1.0.0
 * Author:            Dennis Acker
 * Author URI:        https://lucksmith.de
 * Text Domain:       JSONCreateUserAPI
 * License:           GPL-3.0
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:       /JSONCreateUserAPI
 */


namespace Lucksmith\JSONCreateUserAPI;

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'JSONCreateUserAPI_VERSION', '1.0.0' );

spl_autoload_register(function ($class) {

    $prefix = __NAMESPACE__;
    $base_dir = __DIR__ . '/includes/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

function init() {
	$reactdeepl = Plugin::get_instance();
    $reactdeepl_rest_submission = Endpoint\Submission::get_instance();
}
add_action( 'plugins_loaded', 'Lucksmith\\JSONCreateUserAPI\\init' );

register_activation_hook( __FILE__, array( 'Lucksmith\\JSONCreateUserAPI\\Plugin', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Lucksmith\\JSONCreateUserAPI\\Plugin', 'deactivate' ) );

