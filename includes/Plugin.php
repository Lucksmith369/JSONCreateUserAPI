<?php
/**
 * 
 *
 * @package   JSONCreateUserAPI
 * @author    Dennis Acker
 * @license   GPL-3.0
 * @link      https://lucksmith.de
 * @copyright 2020 Dennis Acker Consulting
 */

namespace Lucksmith\JSONCreateUserAPI;

class Plugin {

	protected $plugin_slug = 'JSONCreateUserAPI';

	protected static $instance = null;


	private function __construct() {
		$this->plugin_version = JSONCreateUserAPI_VERSION;
	}

	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	public function get_plugin_version() {
		return $this->plugin_version;
	}

	public static function activate() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$table_name = $wpdb->prefix . "JSONCreateUserAPI";
		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
		Id bigint NOT NULL AUTO_INCREMENT,
		PRIMARY KEY  (id)
		) $charset_collate;";
		$wpdb->query( $sql );
	}

	public static function deactivate() {
		global $wpdb;

		$table_name = $wpdb->prefix . "JSONCreateUserAPI";
		$sql = "DROP TABLE IF EXISTS $table_name";
		$wpdb->query( $sql );

	}

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
}
