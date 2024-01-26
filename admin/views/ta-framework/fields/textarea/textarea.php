<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.
/**
 *
 * Field: textarea
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'BOP_Field_textarea' ) ) {
	class BOP_Field_textarea extends BOP_Fields {


		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {

			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			echo wp_kses_post( $this->field_before() );
			echo wp_kses_post($this->shortcoder());
			echo '<textarea name="' . esc_attr( $this->field_name() ) . '"' . wp_kses_post($this->field_attributes()) . '>' . esc_html($this->value) . '</textarea>';
			echo wp_kses_post( $this->field_after() );
		}

		public function shortcoder() {

			if ( ! empty( $this->field['shortcoder'] ) ) {

				$shortcodes = ( is_array( $this->field['shortcoder'] ) ) ? $this->field['shortcoder'] : array_filter( (array) $this->field['shortcoder'] );
				$instances  = ( ! empty( BOP::$shortcode_instances ) ) ? BOP::$shortcode_instances : array();

				if ( ! empty( $shortcodes ) && ! empty( $instances ) ) {

					foreach ( $shortcodes as $shortcode ) {

						foreach ( $instances as $instance ) {

							if ( $instance['modal_id'] === $shortcode ) {

								$id    = $instance['modal_id'];
								$title = $instance['button_title'];

								echo '<a href="#" class="button button-primary bop-shortcode-button" data-modal-id="' . esc_attr( $id ) . '">' . esc_html( $title ) . '</a>';

							}
						}
					}
				}
			}
		}
	}
}
