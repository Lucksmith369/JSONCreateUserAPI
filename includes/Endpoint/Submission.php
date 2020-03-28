<?php
/**
 * react-deepl
 *
 *
 * @package   react-deepl
 * @author    Dennis Acker
 * @license   GPL-3.0
 * @link      https://lucksmith.de
 * @copyright 2020 Dennis Acker Consulting
 */

namespace Lucksmith\JSONCreateUserAPI\Endpoint;
use Lucksmith\JSONCreateUserAPI;

/**
 * @subpackage REST_Controller
 */
class Submission {

	protected static $instance = null;

	private function __construct() {
        $plugin = JSONCreateUserAPI\Plugin::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();
	}

    public function do_hooks() {
        add_action( 'rest_api_init', array( $this, 'register_routes' ) );
    }

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
			self::$instance->do_hooks();
		}

		return self::$instance;
	}

    public function register_routes() {
        $version = '1';
        $namespace = $this->plugin_slug . '/v' . $version;
        $endpoint = '/Users/';

        register_rest_route( $namespace, $endpoint, array(
            array(
                'methods'   => \WP_REST_Server::CREATABLE,
                'callback'  => array( $this, 'create_User' ),
                ),
            )
        );
    }

    public function create_User( $request ) {
        $json = $request->get_json_params();
        
        if($json['user_email'] && $json['user_login'] && $json['user_pass'])
        {

        $args = array(
            'user_pass'             => $json['user_pass'],
            'user_email'            => $json['user_email'],
            'user_login'            => $json['user_login'],
            'role'                  => 'subscriber',
            'user_nicename'         => $json['user_nicename'],   //(string) The URL-friendly user name.
            'user_url'              => $json['user_url'],   //(string) The user URL.
            'display_name'          => $json['display_name'],   //(string) The user's display name. Default is the user's username.
            'nickname'              => $json['nickname'],   //(string) The user's nickname. Default is the user's username.
            'first_name'            => $json['first_name'],   //(string) The user's first name. For new users, will be used to build the first part of the user's display name if $display_name is not specified.
            'last_name'             => $json['last_name'],   //(string) The user's last name. For new users, will be used to build the second part of the user's display name if $display_name is not specified.
            'description'           => $json['description'],   //(string) The user's biographical description.
            'rich_editing'          => $json['rich_editing'],   //(string|bool) Whether to enable the rich-editor for the user. False if not empty.
            'syntax_highlighting'   => $json['syntax_highlighting'],   //(string|bool) Whether to enable the rich code editor for the user. False if not empty.
            'comment_shortcuts'     => $json['comment_shortcuts'],   //(string|bool) Whether to enable comment moderation keyboard shortcuts for the user. Default false.
            'user_registered'       => $json['user_registered'],   //(string) Date the user registered. Format is 'Y-m-d H:i:s'.
            'locale'                => $json['locale'],   //(string) User's locale. Default empty.
        );

        $user = wp_insert_user( $args );
        }
        else{
        $user = false;
        }


        return new \WP_REST_Response( array(
            'success'   => true,
            'user'    => $user,
            'req'=> $json['email'],
        ), 200 );
       
    }

}
