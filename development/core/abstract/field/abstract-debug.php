<?php

namespace WPOnion\Bridge\Field;
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( '\WPOnion\Bridge\Field\Debug' ) ) {
	/**
	 * Class Debug
	 *
	 * @package WPOnion\Bridge\Field
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 */
	abstract class Debug extends Conditional_Check {
		/**
		 * @param bool $start
		 *
		 * @return string
		 * @since {NEWVERSION}
		 */
		protected function debug_timer( $start = true ) {
			if ( $start && wponion_is_debug() ) {
				wponion_timer( $this->unique() );
			}

			if ( ! $start && $this->option( 'debug' ) || wponion_is_debug() ) {
				$heading = __( 'Field Rendered In', 'wponion' );
				$timer   = wponion_timer( $this->unique(), true );
				$seconds = __( 'Seconds', 'wponion' );
				return "<div class=\"wponion-developer-timer\"> $heading $timer $seconds </div>";
			}
			return '';
		}

		/**
		 * Stores Debug Info.
		 *
		 * @param string      $key
		 * @param array|mixed $data
		 *
		 * @return array|bool
		 */
		protected function debug( $key = '', $data = array() ) {
			if ( ! empty( $key ) && $this->has( 'debug' ) && ! isset( $this->debug[ $key ] ) ) {
				$this->debug[ $key ] = $data;
			}
			return ( empty( $key ) ) ? $this->debug : false;
		}
	}
}
