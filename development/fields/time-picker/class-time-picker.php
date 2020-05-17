<?php

namespace WPOnion\Field;
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( '\WPOnion\Field\Time_Picker' ) ) {
	/**
	 * Class Time_Picker
	 *
	 * @package WPOnion\Field
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 */
	class Time_Picker extends Date_Picker {
		/**
		 * Generates Final HTML Output.
		 */
		protected function output() {
			echo $this->before();

			echo $this->sub_field( $this->handle_args( 'placeholder', $this->option( 'time' ), array(
				'id'         => $this->field_id(),
				'type'       => 'text',
				'prefix'     => '<i class="wpoic-clock"></i>',
				'only_field' => true,
			) ), $this->value(), $this->unique() );

			echo $this->after();
		}

		/**
		 * Returns Field's Default Value.
		 *
		 * @return array
		 */
		protected function defaults() {
			return array(
				'time'     => __( 'Time', 'wponion' ),
				'settings' => array(),
				'theme'    => 'default',
			);
		}
	}
}
