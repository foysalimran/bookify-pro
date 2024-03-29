<?php
/**
 *
 * Field: Typography
 *
 * @link       https://themeatelier.net/
 *
 * @package Bookify_Pro
 * @subpackage Bookify_Pro/admin/views
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

if ( ! class_exists( 'BOP_Field_typography' ) ) {
	/**
	 *
	 * Field: typography
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class BOP_Field_typography extends BOP_Fields {

		/**
		 * Chosen
		 *
		 * @var bool
		 */
		public $chosen = false;

		/**
		 * Value
		 *
		 * @var array
		 */
		public $value = array();
		/**
		 * The class constructor.
		 *
		 * @param array  $field The field type.
		 * @param string $value The values of the field.
		 * @param string $unique The unique ID for the field.
		 * @param string $where To where show the output CSS.
		 * @param string $parent The parent args.
		 */
		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}
		/**
		 * The render method.
		 *
		 * @return void
		 */
		public function render() {

			echo wp_kses_post( $this->field_before() );

			$args = wp_parse_args(
				$this->field,
				array(
					'font_family'        => true,
					'font_weight'        => true,
					'font_style'         => true,
					'font_size'          => true,
					'line_height'        => true,
					'tablet_font_size'   => true,
					'tablet_line_height' => true,
					'mobile_font_size'   => true,
					'mobile_line_height' => true,
					'letter_spacing'     => true,
					'text_align'         => true,
					'text_transform'     => true,
					'color'              => true,
					'hover_color'        => false,
					'chosen'             => true,
					'preview'            => true,
					'subset'             => true,
					'multi_subset'       => false,
					'extra_styles'       => false,
					'backup_font_family' => false,
					'font_variant'       => false,
					'word_spacing'       => false,
					'text_decoration'    => false,
					'custom_style'       => false,
					'exclude'            => '',
					'unit'               => 'px',
					'preview_text'       => 'The quick brown fox jumps over the lazy dog',
				)
			);

			$default_value = array(
				'font-family'        => '',
				'font-weight'        => '',
				'font-style'         => '',
				'font-variant'       => '',
				'font-size'          => '',
				'line-height'        => '',
				'tablet-font-size'   => '',
				'tablet-line-height' => '',
				'mobile-font-size'   => '',
				'mobile-line-height' => '',
				'letter-spacing'     => '',
				'word-spacing'       => '',
				'text-align'         => '',
				'text-transform'     => '',
				'text-decoration'    => '',
				'backup-font-family' => '',
				'color'              => '',
				'hover_color'        => '',
				'custom-style'       => '',
				'type'               => '',
				'subset'             => '',
				'extra-styles'       => array(),
			);

			$default_value = ( ! empty( $this->field['default'] ) ) ? wp_parse_args( $this->field['default'], $default_value ) : $default_value;
			$this->value   = wp_parse_args( $this->value, $default_value );
			$this->chosen  = $args['chosen'];
			$chosen_class  = ( $this->chosen ) ? ' bop--chosen' : '';

			echo '<div class="bop--typography' . esc_attr( $chosen_class ) . '" data-unit="' . esc_attr( $args['unit'] ) . '" data-exclude="' . esc_attr( $args['exclude'] ) . '">';

			echo '<div class="bop--blocks bop--blocks-selects">';

			//
			// Font Family.
			if ( ! empty( $args['font_family'] ) ) {
				echo '<div class="bop--block">';
				echo '<div class="bop--title">' . esc_html__( 'Font Family', 'bookify-pro' ) . '</div>';
				echo $this->create_select( array( $this->value['font-family'] => $this->value['font-family'] ), 'font-family', esc_html__( 'Select a font', 'bookify-pro' ) );// phpcs:ignore
				echo '</div>';
			}

			//
			// Backup Font Family.
			if ( ! empty( $args['backup_font_family'] ) ) {
				echo '<div class="bop--block bop--block-backup-font-family hidden">';
				echo '<div class="bop--title">' . esc_html__( 'Backup Font Family', 'bookify-pro' ) . '</div>';
				// phpcs:ignore
				echo $this->create_select(
					apply_filters(
						'bop_field_typography_backup_font_family',
						array(
							'Arial, Helvetica, sans-serif',
							"'Arial Black', Gadget, sans-serif",
							"'Comic Sans MS', cursive, sans-serif",
							'Impact, Charcoal, sans-serif',
							"'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
							'Tahoma, Geneva, sans-serif',
							"'Trebuchet MS', Helvetica, sans-serif'",
							'Verdana, Geneva, sans-serif',
							"'Courier New', Courier, monospace",
							"'Lucida Console', Monaco, monospace",
							'Georgia, serif',
							'Palatino Linotype',
						)
					),
					'backup-font-family',
					esc_html__( 'Default', 'bookify-pro' )
				);
				echo '</div>';
			}

			//
			// Font Style and Extra Style Select.
			if ( ! empty( $args['font_weight'] ) || ! empty( $args['font_style'] ) ) {

				//
				// Font Style Select.
				echo '<div class="bop--block bop--block-font-style hidden">';
				echo '<div class="bop--title">' . esc_html__( 'Font Style', 'bookify-pro' ) . '</div>';
				echo '<select class="bop--font-style-select" data-placeholder="Default">';
				echo '<option value="">' . ( ! $this->chosen ? esc_html__( 'Default', 'bookify-pro' ) : '' ) . '</option>';// phpcs:ignore
				if ( ! empty( $this->value['font-weight'] ) || ! empty( $this->value['font-style'] ) ) {
					echo '<option value="' . strtolower( $this->value['font-weight'] . $this->value['font-style'] ) . '" selected></option>';// phpcs:ignore
				}
				echo '</select>';
				echo '<input type="hidden" name="' . esc_attr( $this->field_name( '[font-weight]' ) ) . '" class="bop--font-weight" value="' . esc_attr( $this->value['font-weight'] ) . '" />';
				echo '<input type="hidden" name="' . esc_attr( $this->field_name( '[font-style]' ) ) . '" class="bop--font-style" value="' . esc_attr( $this->value['font-style'] ) . '" />';

				//
				// Extra Font Style Select.
				if ( ! empty( $args['extra_styles'] ) ) {
					echo '<div class="bop--block-extra-styles hidden">';
					echo ( ! $this->chosen ) ? '<div class="bop--title">' . esc_html__( 'Load Extra Styles', 'bookify-pro' ) . '</div>' : '';
					$placeholder = ( $this->chosen ) ? esc_html__( 'Load Extra Styles', 'bookify-pro' ) : esc_html__( 'Default', 'bookify-pro' );
					echo $this->create_select( $this->value['extra-styles'], 'extra-styles', $placeholder, true );// phpcs:ignore
					echo '</div>';
				}

				echo '</div>';

			}

			//
			// Subset.
			if ( ! empty( $args['subset'] ) ) {
				echo '<div class="bop--block bop--block-subset hidden">';
				echo '<div class="bop--title">' . esc_html__( 'Subset', 'bookify-pro' ) . '</div>';
				$subset = ( is_array( $this->value['subset'] ) ) ? $this->value['subset'] : array_filter( (array) $this->value['subset'] );
				echo $this->create_select( $subset, 'subset', esc_html__( 'Default', 'bookify-pro' ), $args['multi_subset'] );// phpcs:ignore
				echo '</div>';
			}

			//
			// Text Align.
			if ( ! empty( $args['text_align'] ) ) {
				echo '<div class="bop--block">';
				echo '<div class="bop--title">' . esc_html__( 'Text Align', 'bookify-pro' ) . '</div>';
				// phpcs:ignore
				echo $this->create_select(
					array(
						'inherit' => esc_html__( 'Inherit', 'bookify-pro' ),
						'left'    => esc_html__( 'Left', 'bookify-pro' ),
						'center'  => esc_html__( 'Center', 'bookify-pro' ),
						'right'   => esc_html__( 'Right', 'bookify-pro' ),
						'justify' => esc_html__( 'Justify', 'bookify-pro' ),
						'initial' => esc_html__( 'Initial', 'bookify-pro' ),
					),
					'text-align',
					esc_html__( 'Default', 'bookify-pro' )
				);
				echo '</div>';
			}

			//
			// Font Variant.
			if ( ! empty( $args['font_variant'] ) ) {
				echo '<div class="bop--block">';
				echo '<div class="bop--title">' . esc_html__( 'Font Variant', 'bookify-pro' ) . '</div>';
				// phpcs:ignore
				echo $this->create_select(
					array(
						'normal'         => esc_html__( 'Normal', 'bookify-pro' ),
						'small-caps'     => esc_html__( 'Small Caps', 'bookify-pro' ),
						'all-small-caps' => esc_html__( 'All Small Caps', 'bookify-pro' ),
					),
					'font-variant',
					esc_html__( 'Default', 'bookify-pro' )
				);
				echo '</div>';
			}

			//
			// Text Transform.
			if ( ! empty( $args['text_transform'] ) ) {
				echo '<div class="bop--block">';
				echo '<div class="bop--title">' . esc_html__( 'Text Transform', 'bookify-pro' ) . '</div>';
				// phpcs:ignore
				echo $this->create_select(
					array(
						'none'       => esc_html__( 'None', 'bookify-pro' ),
						'capitalize' => esc_html__( 'Capitalize', 'bookify-pro' ),
						'uppercase'  => esc_html__( 'Uppercase', 'bookify-pro' ),
						'lowercase'  => esc_html__( 'Lowercase', 'bookify-pro' ),
					),
					'text-transform',
					esc_html__( 'Default', 'bookify-pro' )
				);
				echo '</div>';
			}

			//
			// Text Decoration.
			if ( ! empty( $args['text_decoration'] ) ) {
				echo '<div class="bop--block">';
				echo '<div class="bop--title">' . esc_html__( 'Text Decoration', 'bookify-pro' ) . '</div>';
				// phpcs:ignore
				echo $this->create_select(
					array(
						'none'               => esc_html__( 'None', 'bookify-pro' ),
						'underline'          => esc_html__( 'Solid', 'bookify-pro' ),
						'underline double'   => esc_html__( 'Double', 'bookify-pro' ),
						'underline dotted'   => esc_html__( 'Dotted', 'bookify-pro' ),
						'underline dashed'   => esc_html__( 'Dashed', 'bookify-pro' ),
						'underline wavy'     => esc_html__( 'Wavy', 'bookify-pro' ),
						'underline overline' => esc_html__( 'Overline', 'bookify-pro' ),
						'line-through'       => esc_html__( 'Line-through', 'bookify-pro' ),
					),
					'text-decoration',
					esc_html__( 'Default', 'bookify-pro' )
				);
				echo '</div>';
			}

			echo '</div>'; // End of .bop--blocks-selects.

			echo '<div class="bop--blocks bop--blocks-inputs">';

			//
			// Font Size and Line Height.
			if ( ! empty( $args['font_size'] ) ) {
				echo '<div class="bop--block">';
				echo '<div class="bop--title">' . esc_html__( 'Font Size', 'bookify-pro' ) . '</div>';
				echo '<div class="bop--input-wrap">';
				echo '<input type="number" name="' . esc_attr( $this->field_name( '[font-size]' ) ) . '" class="bop--font-size bop--input bop-input-number" value="' . esc_attr( $this->value['font-size'] ) . '" />';
				echo '<span class="bop--unit">' . esc_attr( $args['unit'] ) . '</span>';
				echo '</div>';
				echo '</div>';
			}
			if ( ! empty( $args['line_height'] ) ) {
				echo '<div class="bop--block">';
				echo '<div class="bop--title">' . esc_html__( 'Line Height', 'bookify-pro' ) . '</div>';
				echo '<div class="bop--input-wrap">';
				echo '<input type="number" name="' . esc_attr( $this->field_name( '[line-height]' ) ) . '" class="bop--line-height bop--input bop-input-number" value="' . esc_attr( $this->value['line-height'] ) . '" />';
				echo '<span class="bop--unit">' . esc_attr( $args['unit'] ) . '</span>';
				echo '</div>';
				echo '</div>';
			}
			if ( ! empty( $args['tablet_font_size'] ) ) {
				echo '<div class="bop--block">';
				echo '<div class="bop--title">' . esc_html__( 'Font Size (Tablet)', 'bookify-pro' ) . '</div>';
				echo '<div class="bop--input-wrap">';
				echo '<input type="number" name="' . esc_attr( $this->field_name( '[tablet-font-size]' ) ) . '" class="bop--font-size bop--input bop-input-number" value="' . esc_attr( $this->value['tablet-font-size'] ) . '" />';
				echo '<span class="bop--unit">' . esc_attr( $args['unit'] ) . '</span>';
				echo '</div>';
				echo '</div>';
			}
			if ( ! empty( $args['tablet_line_height'] ) ) {
				echo '<div class="bop--block">';
				echo '<div class="bop--title">' . esc_html__( 'Line Height (Tablet)', 'bookify-pro' ) . '</div>';
				echo '<div class="bop--input-wrap">';
				echo '<input type="number" name="' . esc_attr( $this->field_name( '[tablet-line-height]' ) ) . '" class="bop--line-height bop--input bop-input-number" value="' . esc_attr( $this->value['tablet-line-height'] ) . '" />';
				echo '<span class="bop--unit">' . esc_attr( $args['unit'] ) . '</span>';
				echo '</div>';
				echo '</div>';
			}
			if ( ! empty( $args['mobile_font_size'] ) ) {
				echo '<div class="bop--block">';
				echo '<div class="bop--title">' . esc_html__( 'Font Size (Mobile)', 'bookify-pro' ) . '</div>';
				echo '<div class="bop--input-wrap">';
				echo '<input type="number" name="' . esc_attr( $this->field_name( '[mobile-font-size]' ) ) . '" class="bop--font-size bop--input bop-input-number" value="' . esc_attr( $this->value['mobile-font-size'] ) . '" />';
				echo '<span class="bop--unit">' . esc_attr( $args['unit'] ) . '</span>';
				echo '</div>';
				echo '</div>';
			}
			if ( ! empty( $args['mobile_line_height'] ) ) {
				echo '<div class="bop--block">';
				echo '<div class="bop--title">' . esc_html__( 'Line Height (Mobile)', 'bookify-pro' ) . '</div>';
				echo '<div class="bop--input-wrap">';
				echo '<input type="number" name="' . esc_attr( $this->field_name( '[mobile-line-height]' ) ) . '" class="bop--line-height bop--input bop-input-number" value="' . esc_attr( $this->value['mobile-line-height'] ) . '" />';
				echo '<span class="bop--unit">' . esc_attr( $args['unit'] ) . '</span>';
				echo '</div>';
				echo '</div>';
			}

			//
			// Letter Spacing.
			if ( ! empty( $args['letter_spacing'] ) ) {
				echo '<div class="bop--block">';
				echo '<div class="bop--title">' . esc_html__( 'Letter Spacing', 'bookify-pro' ) . '</div>';
				echo '<div class="bop--input-wrap">';
				echo '<input type="number" name="' . esc_attr( $this->field_name( '[letter-spacing]' ) ) . '" class="bop--letter-spacing bop--input bop-input-number" value="' . esc_attr( $this->value['letter-spacing'] ) . '" />';
				echo '<span class="bop--unit">' . esc_attr( $args['unit'] ) . '</span>';
				echo '</div>';
				echo '</div>';
			}

			//
			// Word Spacing.
			if ( ! empty( $args['word_spacing'] ) ) {
				echo '<div class="bop--block">';
				echo '<div class="bop--title">' . esc_html__( 'Word Spacing', 'bookify-pro' ) . '</div>';
				echo '<div class="bop--input-wrap">';
				echo '<input type="number" name="' . esc_attr( $this->field_name( '[word-spacing]' ) ) . '" class="bop--word-spacing bop--input bop-input-number" value="' . esc_attr( $this->value['word-spacing'] ) . '" />';
				echo '<span class="bop--unit">' . esc_attr( $args['unit'] ) . '</span>';
				echo '</div>';
				echo '</div>';
			}

			echo '</div>'; // End of bop--blocks-inputs.

			//
			// Font Color.
			if ( ! empty( $args['color'] ) ) {
				echo '<div class="bop--blocks bop--blocks-color">';
				$default_color_attr = ( ! empty( $default_value['color'] ) ) ? ' data-default-color="' . $default_value['color'] . '"' : '';
				echo '<div class="bop--block bop--block-font-color">';
				echo '<div class="bop--title">' . esc_html__( 'Font Color', 'bookify-pro' ) . '</div>';
				echo '<div class="bop-field-color">';
				echo '<input type="text" name="' . esc_attr( $this->field_name( '[color]' ) ) . '" class="bop-color bop--color" value="' . esc_attr( $this->value['color'] ) . '"' . wp_kses_post( $default_color_attr ) . ' />';
				echo '</div>';
				echo '</div>';

				//
				// Font Hover Color.
				if ( ! empty( $args['hover_color'] ) ) {
					$default_hover_color_attr = ( ! empty( $default_value['hover_color'] ) ) ? ' data-default-color="' . $default_value['hover_color'] . '"' : '';
					echo '<div class="bop--block bop--block-font-color">';
					echo '<div class="bop--title">' . esc_html__( 'Hover Color', 'bookify-pro' ) . '</div>';
					echo '<div class="bop-field-color">';
					echo '<input type="text" name="' . esc_attr( $this->field_name( '[hover_color]' ) ) . '" class="bop-color bop--color" value="' . esc_attr( $this->value['hover_color'] ) . '"' . wp_kses_post( $default_hover_color_attr ) . ' />';
					echo '</div>';
					echo '</div>';
				}
				echo '</div>'; // End of bop--blocks-color.
			}

			//
			// Custom style.
			if ( ! empty( $args['custom_style'] ) ) {
				echo '<div class="bop--block bop--block-custom-style">';
				echo '<div class="bop--title">' . esc_html__( 'Custom Style', 'bookify-pro' ) . '</div>';
				echo '<textarea name="' . esc_attr( $this->field_name( '[custom-style]' ) ) . '" class="bop--custom-style">' . esc_attr( $this->value['custom-style'] ) . '</textarea>';
				echo '</div>';
			}

			//
			// Preview.
			$always_preview = ( 'always' !== $args['preview'] ) ? ' hidden' : '';

			if ( ! empty( $args['preview'] ) ) {
				echo '<div class="bop--block bop--block-preview' . esc_attr( $always_preview ) . '">';
				echo '<div class="bop--toggle fas fa-toggle-off"></div>';
				echo '<div class="bop--preview">' . esc_html( $args['preview_text'] ) . '</div>';
				echo '</div>';
			}

			echo '<input type="hidden" name="' . esc_attr( $this->field_name( '[type]' ) ) . '" class="bop--type" value="' . esc_attr( $this->value['type'] ) . '" />';
			echo '<input type="hidden" name="' . esc_attr( $this->field_name( '[unit]' ) ) . '" class="bop--unit-save" value="' . esc_attr( $args['unit'] ) . '" />';

			echo '</div>';

			echo wp_kses_post( $this->field_after() );

		}

		/**
		 * Create_select
		 *
		 * @param  mixed $options options.
		 * @param  mixed $name name.
		 * @param  mixed $placeholder placeholder.
		 * @param  mixed $is_multiple multiple.
		 * @return statement
		 */
		public function create_select( $options, $name, $placeholder = '', $is_multiple = false ) {

			$multiple_name = ( $is_multiple ) ? '[]' : '';
			$multiple_attr = ( $is_multiple ) ? ' multiple data-multiple="true"' : '';
			$chosen_rtl    = ( $this->chosen && is_rtl() ) ? ' chosen-rtl' : '';

			$output  = '<select name="' . $this->field_name( '[' . $name . ']' . $multiple_name ) . '" class="bop--' . $name . $chosen_rtl . '" data-placeholder="' . wp_kses_post($placeholder) . '"' . $multiple_attr . '>';
			$output .= ( ! empty( $placeholder ) ) ? '<option value="">' . ( ( ! $this->chosen ) ? $placeholder : '' ) . '</option>' : '';

			if ( ! empty( $options ) ) {
				foreach ( $options as $option_key => $bop_metabox_value ) {
					if ( $is_multiple ) {
						$selected = ( in_array( $bop_metabox_value, $this->value[ $name ] ) ) ? ' selected' : '';
						$output  .= '<option value="' . $bop_metabox_value . '"' . $selected . '>' . $bop_metabox_value . '</option>';
					} else {
						$option_key = ( is_numeric( $option_key ) ) ? $bop_metabox_value : $option_key;
						$selected   = ( $option_key === $this->value[ $name ] ) ? ' selected' : '';
						$output    .= '<option value="' . $option_key . '"' . $selected . '>' . $bop_metabox_value . '</option>';
					}
				}
			}

			$output .= '</select>';

			return $output;

		}

		/**
		 * Enqueue
		 *
		 * @return void
		 */
		public function enqueue() {

			if ( ! wp_style_is( 'bop-webfont-loader' ) ) {

				BOP::include_plugin_file( 'fields/typography/google-fonts.php' );

				wp_enqueue_script( 'bop-webfont-loader', 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js', array( 'bop' ), '1.6.28', true );

				$webfonts = array();

				$customwebfonts = apply_filters( 'bop_field_typography_customwebfonts', array() );

				if ( ! empty( $customwebfonts ) ) {
					$webfonts['custom'] = array(
						'label' => esc_html__( 'Custom Web Fonts', 'bookify-pro' ),
						'fonts' => $customwebfonts,
					);
				}

				$webfonts['safe'] = array(
					'label' => esc_html__( 'Safe Web Fonts', 'bookify-pro' ),
					'fonts' => apply_filters(
						'bop_field_typography_safewebfonts',
						array(
							'Arial',
							'Arial Black',
							'Helvetica',
							'Times New Roman',
							'Courier New',
							'Tahoma',
							'Verdana',
							'Impact',
							'Trebuchet MS',
							'Comic Sans MS',
							'Lucida Console',
							'Lucida Sans Unicode',
							'Georgia, serif',
							'Palatino Linotype',
						)
					),
				);

				$webfonts['google'] = array(
					'label' => esc_html__( 'Google Web Fonts', 'bookify-pro' ),
					'fonts' => apply_filters(
						'bop_field_typography_googlewebfonts',
						bop_get_google_fonts()
					),
				);

				$defaultstyles = apply_filters( 'bop_field_typography_defaultstyles', array( 'normal', 'italic', '700', '700italic' ) );

				$googlestyles = apply_filters(
					'bop_field_typography_googlestyles',
					array(
						'100'       => 'Thin 100',
						'100italic' => 'Thin 100 Italic',
						'200'       => 'Extra-Light 200',
						'200italic' => 'Extra-Light 200 Italic',
						'300'       => 'Light 300',
						'300italic' => 'Light 300 Italic',
						'normal'    => 'Normal 400',
						'italic'    => 'Normal 400 Italic',
						'500'       => 'Medium 500',
						'500italic' => 'Medium 500 Italic',
						'600'       => 'Semi-Bold 600',
						'600italic' => 'Semi-Bold 600 Italic',
						'700'       => 'Bold 700',
						'700italic' => 'Bold 700 Italic',
						'800'       => 'Extra-Bold 800',
						'800italic' => 'Extra-Bold 800 Italic',
						'900'       => 'Black 900',
						'900italic' => 'Black 900 Italic',
					)
				);

				$webfonts = apply_filters( 'bop_field_typography_webfonts', $webfonts );

				wp_localize_script(
					'bop',
					'bop_typography_json',
					array(
						'webfonts'      => $webfonts,
						'defaultstyles' => $defaultstyles,
						'googlestyles'  => $googlestyles,
					)
				);

			}

		}

		/**
		 * Enqueue_google_fonts
		 *
		 * @return statement
		 */
		public function enqueue_google_fonts() {

			$value     = $this->value;
			$families  = array();
			$is_google = false;

			if ( ! empty( $this->value['type'] ) ) {
				$is_google = ( 'google' === $this->value['type'] ) ? true : false;
			} else {
				BOP::include_plugin_file( 'fields/typography/google-fonts.php' );
				$is_google = ( array_key_exists( $this->value['font-family'], bop_get_google_fonts() ) ) ? true : false;
			}

			if ( $is_google ) {

				// set style.
				$font_weight = ( ! empty( $value['font-weight'] ) ) ? $value['font-weight'] : '';
				$font_style  = ( ! empty( $value['font-style'] ) ) ? $value['font-style'] : '';

				if ( $font_weight || $font_style ) {
					$style                       = $font_weight . $font_style;
					$families['style'][ $style ] = $style;
				}

				// set extra styles.
				if ( ! empty( $value['extra-styles'] ) ) {
					foreach ( $value['extra-styles'] as $extra_style ) {
						$families['style'][ $extra_style ] = $extra_style;
					}
				}

				// set subsets.
				if ( ! empty( $value['subset'] ) ) {
					$value['subset'] = ( is_array( $value['subset'] ) ) ? $value['subset'] : array_filter( (array) $value['subset'] );
					foreach ( $value['subset'] as $subset ) {
						$families['subset'][ $subset ] = $subset;
					}
				}

				$all_styles  = ( ! empty( $families['style'] ) ) ? ':' . implode( ',', $families['style'] ) : '';
				$all_subsets = ( ! empty( $families['subset'] ) ) ? ':' . implode( ',', $families['subset'] ) : '';

				$families = $this->value['font-family'] . str_replace( array( 'normal', 'italic' ), array( 'n', 'i' ), $all_styles ) . $all_subsets;

				$this->parent->typographies[] = $families;

				return $families;

			}

			return false;

		}
	}
}
