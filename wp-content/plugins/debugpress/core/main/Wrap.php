<?php

namespace Dev4Press\Plugin\DebugPress\Main;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Wrap {
	function __construct( $args = array() ) {
		if ( is_array( $args ) && ! empty( $args ) ) {
			$this->from_array( $args );
		}
	}

	function __clone() {
		foreach ( $this as $key => $val ) {
			if ( is_object( $val ) || ( is_array( $val ) ) ) {
				$this->{$key} = unserialize( serialize( $val ) );
			}
		}
	}

	public function to_array() : array {
		return (array) $this;
	}

	public function from_array( $args ) {
		foreach ( $args as $key => $value ) {
			$this->$key = $value;
		}
	}
}