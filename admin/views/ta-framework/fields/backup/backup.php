<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.
/**
 *
 * Field: backup
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'BOP_Field_backup' ) ) {
	class BOP_Field_backup extends BOP_Fields {


		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {

			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$unique = $this->unique;
			$nonce  = wp_create_nonce( 'bop_backup_nonce' );
			$export = add_query_arg(
				array(
					'action' => 'bop-export',
					'unique' => $unique,
					'nonce'  => $nonce,
				),
				admin_url( 'admin-ajax.php' )
			);

			echo wp_kses_post( $this->field_before() );

			echo '<textarea name="bop_import_data" class="bop-import-data"></textarea>';
			echo '<button type="submit" class="button button-primary bop-confirm bop-import" data-unique="' . esc_attr( $unique ) . '" data-nonce="' . esc_attr( $nonce ) . '">' . esc_html__( 'Import', 'bookify-pro' ) . '</button>';
			echo '<hr />';
			echo '<textarea readonly="readonly" class="bop-export-data">' . esc_attr( json_encode( get_option( $unique ) ) ) . '</textarea>';
			echo '<a href="' . esc_url( $export ) . '" class="button button-primary bop-export" target="_blank">' . esc_html__( 'Export & Download', 'bookify-pro' ) . '</a>';
			echo '<hr />';
			echo '<button type="submit" name="bop_transient[reset]" value="reset" class="button bop-warning-primary bop-confirm bop-reset" data-unique="' . esc_attr( $unique ) . '" data-nonce="' . esc_attr( $nonce ) . '">' . esc_html__( 'Reset', 'bookify-pro' ) . '</button>';

			echo wp_kses_post( $this->field_after() );
		}
	}
}
