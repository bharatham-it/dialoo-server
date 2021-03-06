<?php

namespace Dev4Press\Plugin\DebugPress\Main;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WP {
	public function __construct() {

	}

	/** @return \Dev4Press\Plugin\DebugPress\Main\WP */
	public static function instance() : WP {
		static $instance = null;

		if ( ! isset( $instance ) ) {
			$instance = new WP();
		}

		return $instance;
	}

	public function has_permalinks() {
		return get_option( 'permalink_structure' );
	}

	public function current_url( $use_wp = true ) : string {
		if ( $use_wp ) {
			return home_url( $this->current_url_request() );
		} else {
			$s        = empty( $_SERVER['HTTPS'] ) ? '' : ( $_SERVER['HTTPS'] == 'on' ? 's' : '' );
			$protocol = debugpress_strleft( strtolower( $_SERVER['SERVER_PROTOCOL'] ), '/' ) . $s;
			$port     = $_SERVER['SERVER_PORT'] == '80' || $_SERVER['SERVER_PORT'] == '443' ? '' : ':' . $_SERVER['SERVER_PORT'];

			return $protocol . '://' . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
		}
	}

	public function current_url_request() : string {
		$pathinfo = isset( $_SERVER['PATH_INFO'] ) ? $_SERVER['PATH_INFO'] : '';
		list( $pathinfo ) = explode( '?', $pathinfo );
		$pathinfo = str_replace( '%', '%25', $pathinfo );

		$request         = explode( '?', $_SERVER['REQUEST_URI'] );
		$req_uri         = $request[0];
		$req_query       = isset( $request[1] ) ? $request[1] : false;
		$home_path       = trim( parse_url( home_url(), PHP_URL_PATH ), '/' );
		$home_path_regex = sprintf( '|^%s|i', preg_quote( $home_path, '|' ) );

		$req_uri = str_replace( $pathinfo, '', $req_uri );
		$req_uri = trim( $req_uri, '/' );
		$req_uri = preg_replace( $home_path_regex, '', $req_uri );
		$req_uri = trim( $req_uri, '/' );

		$url_request = $req_uri;

		if ( $req_query !== false ) {
			$url_request .= '?' . $req_query;
		}

		return $url_request;
	}
}