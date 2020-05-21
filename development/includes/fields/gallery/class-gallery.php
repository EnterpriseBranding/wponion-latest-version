<?php

namespace WPOnion\Field;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( '\WPOnion\Field\Gallery' ) ) {
	/**
	 * Class gallery
	 *
	 * @package WPOnion\Field
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 */
	class Gallery extends image {

		/**
		 * Generates Final HTML Output.
		 */
		protected function output() {
			echo $this->before();
			$sortable = ( true === $this->option( 'sort' ) ) ? 'gallery-sortable' : 'gallery-non-sortable';

			echo <<<HTML
<input type="hidden" id="image_id" value="{$this->value()}" name="{$this->name()}"/>
<div class="wponion-image-preview ${sortable}" id="wponion-image-preview{$this->js_field_id()}">
HTML;
			if ( ! empty( $this->value() ) ) {
				$ids = explode( ',', $this->value() );
				if ( ! empty( $ids ) ) {
					foreach ( $ids as $image ) {
						echo $this->show_image( $image );
					}
				}
			}

			echo '</div> <div class="wponion-gallery-actions">';
			echo $this->button( 'add' );
			echo $this->button( 'edit' );
			echo $this->button( 'clear' );
			echo '</div>';
			echo $this->style();
			echo $this->after();
		}

		/**
		 * Renders its sub fields (Only Button).
		 *
		 * @param $type
		 *
		 * @return mixed
		 */
		protected function button( $type ) {
			$button     = array();
			$base_field = wpo_field( 'button' );
			$base_field->button_type( 'button' )
				->only_field( true )
				->label( __( 'Add Gallery', 'wponion' ) )
				->field_class( 'button button-primary' );
			if ( 'add' === $type ) {
				$button = $this->handle_args( 'label', $this->option( 'add_button' ), $base_field, array(
					'attributes' => array( 'data-wponion-gallery-add' => 'yes' ),
				) );
			} elseif ( 'edit' === $type ) {
				$button = $this->handle_args( 'label', $this->option( 'edit_button' ), $base_field, array(
					'attributes' => array( 'data-wponion-gallery-edit' => 'yes' ),
					'label'      => __( 'Edit Gallery' ),
					'class'      => 'button button-secondary',
				) );
			} elseif ( 'clear' === $type ) {
				$button = $this->handle_args( 'label', $this->option( 'remove_button' ), $base_field, array(
					'attributes' => array( 'data-wponion-gallery-clear' => 'yes' ),
					'label'      => __( 'Clear Gallery' ),
					'class'      => 'button button-secondary',
				) );
			}

			return $this->sub_field( $button, false, $this->unique(), false );
		}

		/**
		 * Returns Field's Default Value.
		 */
		protected function defaults() {
			return array(
				'add_button'    => __( 'Create Gallery', 'wponion' ),
				'edit_button'   => __( 'Edit Gallery', 'wponion' ),
				'size'          => 100,
				'sort'          => true,
				'remove_button' => __( 'Clear Gallery', 'wponion' ),
			);
		}

		/**
		 * Returns all required values to use in js.
		 *
		 * @return array
		 */
		protected function js_args() {
			return array( 'html_template' => $this->show_image( false, null ) );
		}

		/**
		 * Handles Fields Assets.
		 */
		public function assets() {
			wp_enqueue_media();
			if ( $this->has( 'sort' ) && true === $this->option( 'sort' ) ) {
				wp_enqueue_script( 'jquery-ui-sortable' );
			}
		}
	}
}
