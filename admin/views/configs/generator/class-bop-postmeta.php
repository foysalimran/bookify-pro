<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
/**
 * @package    Bookify_Pro
 * @author     ThemeAtelier
 *
 * Websites: http://www.themeatelier.net
 *
 *
 */
// Control core classes for avoid errors
class BOP_Postmeta
{

    /**
     * Display options section metabox.
     *
     * @param string $prefix The metabox key.
     * @return void
     */
    public static function section($prefix)
    {
        //
        // Create a section
        BOP::createSection($prefix, array(
            'fields' => array(
                array(
                    'id'    => 'bop_subtitle',
                    'type'  => 'text',
                    'title' => esc_html__('Subtitle', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_author',
                    'type'  => 'text',
                    'title' => esc_html__('Author', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_publisher',
                    'type'  => 'text',
                    'title' => esc_html__('Publisher', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_publish_date',
                    'type'  => 'date',
                    'title' => esc_html__('Publish Date', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_isbn',
                    'type'  => 'text',
                    'title' => esc_html__('ISBN', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_isbn_10',
                    'type'  => 'text',
                    'title' => esc_html__('ISBN-10', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_isbn_13',
                    'type'  => 'text',
                    'title' => esc_html__('ISBN-13', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_asin',
                    'type'  => 'text',
                    'title' => esc_html__('ASIN', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_subject',
                    'type'  => 'text',
                    'title' => esc_html__('Subject', 'bookify-pro'),
                    'desc'  => esc_html__('eg:  Self-Help / Compulsive Behavior / General', 'bookify-pro')
                ),
                array(
                    'id'    => 'bop_book_genre',
                    'type'  => 'text',
                    'title' => esc_html__('Genre', 'bookify-pro'),
                    'desc'  => esc_html__('eg: Motivational / Self-help book', 'bookify-pro')
                ),
                array(
                    'id'    => 'bop_country',
                    'type'  => 'text',
                    'title' => esc_html__('Country', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_language',
                    'type'  => 'text',
                    'title' => esc_html__('Book language', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_translator_name',
                    'type'  => 'text',
                    'title' => esc_html__('Translator Name', 'bookify-pro'),
                ),
                array(
                    'id'        => 'book_format',
                    'type'      => 'fieldset',
                    'title'     => esc_html__('Book Format', 'bookify-pro'),
                    'fields'    => array(
                        array(
                            'id'    => 'bop_book_format',
                            'type'  => 'select',
                            'title' => esc_html__('Book Format', 'bookify-pro'),
                            'options' => array(
                                'text' => esc_html__('Text', 'bookify-pro'),
                                'ebook' => esc_html__('E-book', 'bookify-pro'),
                                'audio' => esc_html__('Audio', 'bookify-pro'),
                            ),
                        ),
                        array(
                            'id'    => 'bop_book_page',
                            'type'  => 'text',
                            'title' => esc_html__('Book Pages', 'bookify-pro'),
                            'dependency' => array('bop_book_format', '==', 'text'),
                        ),
                        array(
                            'id'    => 'bop_book_dimension',
                            'type'  => 'text',
                            'title' => esc_html__('Dimension', 'bookify-pro'),
                            'dependency' => array('bop_book_format', '==', 'text'),
                        ),
                        array(
                            'id'    => 'bop_book_weight',
                            'type'  => 'text',
                            'title' => esc_html__('Weight', 'bookify-pro'),
                            'dependency' => array('bop_book_format', '==', 'text'),
                        ),
                        array(
                            'id'    => 'bop_book_file_size',
                            'type'  => 'text',
                            'title' => esc_html__('File size', 'bookify-pro'),
                            'dependency' => array('bop_book_format', '!=', 'text'),
                        ),
                        array(
                            'id'    => 'bop_book_file_format',
                            'type'  => 'text',
                            'title' => esc_html__('File Format', 'bookify-pro'),
                            'dependency' => array('bop_book_format', '!=', 'text'),
                        ),
                    ),
                ),
                array(
                    'id'    => 'bop_book_rating',
                    'type'  => 'slider',
                    'title' => esc_html__('Ratings', 'bookify-pro'),
                    'min'     => 0,
                    'max'     => 5,
                    'step'    => 1,
                    'unit'    => 'px',
                    'default' => 4,
                ),
                array(
                    'id'    => 'bop_book_regular_price',
                    'type'  => 'text',
                    'title' => esc_html__('Book Regular Prices', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_sale_price',
                    'type'  => 'text',
                    'title' => esc_html__('Book Sale Prices', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_buy_button_text',
                    'type'  => 'text',
                    'title' => esc_html__('Buy Button Text', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_buy_button_link',
                    'type'  => 'text',
                    'title' => esc_html__('Buy Button Link', 'bookify-pro'),
                ),
                array(
                    'id'        => 'bop_book_multiple_purchase_link',
                    'type'      => 'repeater',
                    'title'     => esc_html__('Book Multiple Purchase Link', 'bookify-pro'),
                    'fields'    => array(


                        array(
                            'id'    => 'bop_website_icon_or_image',
                            'type'  => 'button_set',
                            'title' => esc_html__('Website Icon/Image', 'bookify-pro'),
                            'options'    => array(
                                'icon'  => esc_html__('Icon', 'bookify-pro'),
                                'image' => esc_html__('Image', 'bookify-pro'),
                            ),
                            'default'    => 'icon'
                        ),

                        array(
                            'id'    => 'bop_website_icon',
                            'type'  => 'icon',
                            'title' => esc_html__('Website Icon', 'bookify-pro'),
                            'dependency' => array('bop_website_icon_or_image', '==', 'icon')
                        ),
                        array(
                            'id'    => 'bop_website_image',
                            'type'    => 'media',
                            'title' => esc_html__('Website Image Icon', 'bookify-pro'),
                            'preview' => false,
                            'dependency' => array('bop_website_icon_or_image', '==', 'image')
                        ),
                        array(
                            'id'    => 'bop_website_text',
                            'type'  => 'text',
                            'title' => esc_html__('Website Name', 'bookify-pro'),
                        ),
                        array(
                            'id'    => 'bop_website_link',
                            'type'  => 'text',
                            'title' => esc_html__( 'Website Link', 'bookify-pro' ),
                        ),
                    ),
                ),
            )
        ));
    }
}
