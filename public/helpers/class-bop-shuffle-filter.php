<?php

/**
 * Shuffle filter helper method file.
 *
 * @package Bookify_pro
 * @subpackage Bookify_pro/public/helper
 *
 * @since 2.0.0
 */

/**
 * Shuffle filter helper class.
 *
 * @since 2.0.0
 */
class Bookify_Pro_Shuffle_Filter {



	/**
	 * Shuffle filter markup style.
	 *
	 * @param string $filter_type Filter type.
	 * @param string $taxonomy Current taxonomy to view.
	 * @param string $all_text all text.
	 * @param bool   $show_count show/hide post count.
	 * @param int    $term term id.
	 * @param string $name term name.
	 * @param string $slug term slug.
	 * @param int    $p_count term found post.
	 * @param array  $selected_term selected terms.
	 * @param array  $selected_taxs selected taxonomys.
	 * @param int    $selected_term_id selected term id.

	 * @return array
	 */
	public static function bop_filter_style( $filter_type, $taxonomy, $all_text, $show_count = false, $term = null, $name = null, $slug = null, $p_count = null, $selected_term = null, $selected_taxs = null, $selected_term_id = null ) {
		if ( $show_count ) {
			$post_count_markup = '<span class="bop-count">(' . $p_count . ')</span>';
		} else {
			$post_count_markup = '';
		}

		$taxonomy_name = ( 'post_tag' === $taxonomy ) ? 'tag' : $taxonomy;
		$slug          = trim( sanitize_html_class( $slug, $term ), '-' ) ? sanitize_html_class( $slug, $term ) : $term;
		// Shuffle Filter.
		if ( 'button' === $filter_type ) {
			$first_item = $all_text ? '<button class="bop-button is-active" data-termid="all" data-filter="">' . $all_text . '</button>' : '';
			$push_item  = '<button class="bop-button" data-termid="' . $term . '" data-filter=".' . $taxonomy_name . '-' . $slug . '">' . $name . $post_count_markup . '</button>';
		} else {
			$all_item_text = $all_text ? '<option value="*">' . $all_text . '</option>' : '';
			$first_item    = '<select>' . $all_item_text;
			$push_item     = '<option value=".' . $taxonomy_name . '-' . $slug . '">' . $name . $post_count_markup . '</option>';
		}

		$filter_output = array(
			'first_item' => $first_item,
			'push_item'  => $push_item,
		);
		return $filter_output;
	}

	/**
	 * Shuffle filter.
	 *
	 * @param array  $view_options Shortcode options.
	 * @param array  $layout_preset layout preset.
	 * @param object $bop_query wp query object.
	 * @param string $filter_type Filter type.
	 * @return void
	 */
	public static function bop_shuffle_filter( $view_options, $layout_preset, $bop_query, $filter_type ) {
		$filter_by    = isset( $view_options['bop_advanced_filter'] ) ? $view_options['bop_advanced_filter'] : '';
		$filter_type  = isset( $view_options['bop_filter_type'] ) ? $view_options['bop_filter_type'] : '';
		$filer_align  = isset( $view_options['bop_filer_align'] ) ? $view_options['bop_filer_align'] : 'bop-align-center';
		$all_text_btn = isset( $view_options['bop_filter_all_btn_switch'] ) ? $view_options['bop_filter_all_btn_switch'] : true;
		$all_text     = isset( $view_options['bop_rename_all_text'] ) ? $view_options['bop_rename_all_text'] : 'All';
		$all_text     = $all_text_btn ? $all_text : '';
		$show_count   = isset( $view_options['bop_post_count'] ) ? $view_options['bop_post_count'] : '';
		$post_limit   = isset( $view_options['bop_post_limit'] ) && ! empty( $view_options['bop_post_limit'] ) ? $view_options['bop_post_limit'] : 10000;
		if ( 'filter_layout' === $layout_preset && in_array( 'taxonomy', $filter_by, true ) ) {
			$taxonomy_types   = isset( $view_options['bop_filter_by_taxonomy']['bop_taxonomy_and_terms'] ) && ! empty( $view_options['bop_filter_by_taxonomy']['bop_taxonomy_and_terms'] ) ? $view_options['bop_filter_by_taxonomy']['bop_taxonomy_and_terms'] : '';
			$total_post_count = $bop_query->post_count;
			if ( ! empty( $taxonomy_types ) ) {
				$output         = '';
				$newterm_array  = array();
				$count          = 0;
				$taxonomies     = array();
				$taxonomy_count = count( $taxonomy_types );
				while ( $count < $taxonomy_count ) {
					$taxonomy = isset( $taxonomy_types[ $count ]['bop_select_taxonomy'] ) ? $taxonomy_types[ $count ]['bop_select_taxonomy'] : '';

					$all_terms = get_terms(
						$taxonomy,
						array(
							'get'    => 'all',
							'fields' => 'ids',
						)
					);
					$terms     = isset( $taxonomy_types[ $count ]['bop_select_terms'] ) ? $taxonomy_types[ $count ]['bop_select_terms'] : $all_terms;

					if ( ! empty( $terms ) ) {
						$filter_item             = self::bop_filter_style( $filter_type, $taxonomy, $all_text );
						$newterm_array[ $count ] = array( $filter_item['first_item'] );
						foreach ( $terms as $term ) {
							$p_term          = get_term( $term, $taxonomy );
							$term_post_count = $p_term->count;
							$term_post_count = $term_post_count > $post_limit ? $post_limit : $term_post_count;
							if ( $term_post_count ) {
								$push_item = self::bop_filter_style( $filter_type, $taxonomy, $all_text, $show_count, $term, $p_term->name, $p_term->slug, $term_post_count )['push_item'];
								array_push( $newterm_array[ $count ], $push_item );
							}
						}
						$tax_html = implode( ' ', $newterm_array[ $count ] );
						$output   = $output . '<div class="taxonomy-group" style="text-align:' . $filer_align . '" data-filter-group="' . $taxonomy . '">' . force_balance_tags( $tax_html ) . '</div>';
					}
					++$count;
				}
			}

			echo wp_kses_post( $output );
		}
	}
}
