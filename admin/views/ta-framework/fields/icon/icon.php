<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: icon
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'BOP_Field_icon' ) ) {
  class BOP_Field_icon extends BOP_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'button_title' => esc_html__( 'Add Icon', 'bookify-pro' ),
        'remove_title' => esc_html__( 'Remove Icon', 'bookify-pro' ),
      ) );

      echo wp_kses_post( $this->field_before() );

      $nonce  = wp_create_nonce( 'bop_icon_nonce' );
      $hidden = ( empty( $this->value ) ) ? ' hidden' : '';

      echo '<div class="bop-icon-select">';
      echo '<span class="bop-icon-preview'. esc_attr( $hidden ) .'"><i class="'. esc_attr( $this->value ) .'"></i></span>';
      echo '<a href="#" class="button button-primary bop-icon-add" data-nonce="'. esc_attr( $nonce ) .'">'. $args['button_title'] .'</a>';
      echo '<a href="#" class="button bop-warning-primary bop-icon-remove'. esc_attr( $hidden ) .'">'. $args['remove_title'] .'</a>';
      echo '<input type="hidden" name="'. esc_attr( $this->field_name() ) .'" value="'. esc_attr( $this->value ) .'" class="bop-icon-value"'. $this->field_attributes() .' />';
      echo '</div>';

      echo wp_kses_post( $this->field_after() );

    }

    public function enqueue() {
      add_action( 'admin_footer', array( 'BOP_Field_icon', 'add_footer_modal_icon' ) );
      add_action( 'customize_controls_print_footer_scripts', array( 'BOP_Field_icon', 'add_footer_modal_icon' ) );
    }

    public static function add_footer_modal_icon() {
    ?>
      <div id="bop-modal-icon" class="bop-modal bop-modal-icon hidden">
        <div class="bop-modal-table">
          <div class="bop-modal-table-cell">
            <div class="bop-modal-overlay"></div>
            <div class="bop-modal-inner">
              <div class="bop-modal-title">
                <?php esc_html_e( 'Add Icon', 'bookify-pro' ); ?>
                <div class="bop-modal-close bop-icon-close"></div>
              </div>
              <div class="bop-modal-header">
                <input type="text" placeholder="<?php esc_html_e( 'Search...', 'bookify-pro' ); ?>" class="bop-icon-search" />
              </div>
              <div class="bop-modal-content">
                <div class="bop-modal-loading"><div class="bop-loading"></div></div>
                <div class="bop-modal-load"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
    }

  }
}
