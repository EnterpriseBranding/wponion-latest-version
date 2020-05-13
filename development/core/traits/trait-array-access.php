<?php

namespace WPOnion\Traits;

use WPOnion\Helper;

defined( 'ABSPATH' ) || exit;

if ( ! trait_exists( '\WPOnion\Traits\Array_Access' ) ) {
	/**
	 * Trait Access
	 *
	 * @package WPOnion\Traits
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 */
	trait Array_Access {
		/**
		 * @param mixed $offset
		 *
		 * @return bool
		 */
		public function offsetExists( $offset ) {
			return Helper::array_key_isset( $offset, $this->{$this->array_var} );
		}

		/**
		 * @param mixed $offset
		 *
		 * @return mixed
		 */
		public function offsetGet( $offset ) {
			$defaults = $this->defaults();
			if ( $this->offsetExists( $offset ) ) {
				return $this->{$this->array_var}[ $offset ];
			} elseif ( isset( $defaults[ $offset ] ) ) {
				return $defaults[ $offset ];
			}
			return false;
		}

		/**
		 * @param mixed $offset
		 * @param mixed $value
		 */
		public function offsetSet( $offset, $value ) {
			Helper::array_key_set( $offset, $value, $this->{$this->array_var} );
		}

		/**
		 * @param mixed $offset
		 */
		public function offsetUnset( $offset ) {
			Helper::array_key_unset( $offset, $this->{$this->array_var} );
		}
	}
}
