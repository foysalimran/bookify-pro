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
                    'title' => __('Subtitle', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_author',
                    'type'  => 'text',
                    'title' => __('Author', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_publisher',
                    'type'  => 'text',
                    'title' => __('Publisher', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_publish_date',
                    'type'  => 'date',
                    'title' => __('Publish Date', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_isbn',
                    'type'  => 'text',
                    'title' => __('ISBN', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_isbn_10',
                    'type'  => 'text',
                    'title' => __('ISBN-10', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_isbn_13',
                    'type'  => 'text',
                    'title' => __('ISBN-13', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_asin',
                    'type'  => 'text',
                    'title' => __('ASIN', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_subject',
                    'type'  => 'text',
                    'title' => __('Subject', 'bookify-pro'),
                    'desc'  => __('eg:  Self-Help / Compulsive Behavior / General', 'bookify-pro')
                ),
                array(
                    'id'    => 'bop_book_genre',
                    'type'  => 'text',
                    'title' => __('Genre', 'bookify-pro'),
                    'desc'  => __('eg: Motivational / Self-help book', 'bookify-pro')
                ),
                array(
                    'id'    => 'bop_country',
                    'type'  => 'text',
                    'title' => __('Country', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_language',
                    'type'  => 'text',
                    'title' => __('Book language', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_translator_name',
                    'type'  => 'text',
                    'title' => __('Translator Name', 'bookify-pro'),
                ),
                array(
                    'id'        => 'book_format',
                    'type'      => 'fieldset',
                    'title'     => 'Book Format',
                    'fields'    => array(
                        array(
                            'id'    => 'bop_book_format',
                            'type'  => 'select',
                            'title' => __('Book Format', 'bookify-pro'),
                            'options' => array(
                                'text' => __('Text', 'bookify-pro'),
                                'ebook' => __('E-book', 'bookify-pro'),
                                'audio' => __('Audio', 'bookify-pro'),
                            ),
                        ),
                        array(
                            'id'    => 'bop_book_page',
                            'type'  => 'text',
                            'title' => __('Book Pages', 'bookify-pro'),
                            'dependency' => array('bop_book_format', '==', 'text'),
                        ),
                        array(
                            'id'    => 'bop_book_dimension',
                            'type'  => 'text',
                            'title' => __('Dimension', 'bookify-pro'),
                            'dependency' => array('bop_book_format', '==', 'text'),
                        ),
                        array(
                            'id'    => 'bop_book_weight',
                            'type'  => 'text',
                            'title' => __('Weight', 'bookify-pro'),
                            'dependency' => array('bop_book_format', '==', 'text'),
                        ),
                        array(
                            'id'    => 'bop_book_file_size',
                            'type'  => 'text',
                            'title' => __('File size', 'bookify-pro'),
                            'dependency' => array('bop_book_format', '!=', 'text'),
                        ),
                        array(
                            'id'    => 'bop_book_file_format',
                            'type'  => 'text',
                            'title' => __('File Format', 'bookify-pro'),
                            'dependency' => array('bop_book_format', '!=', 'text'),
                        ),
                    ),
                ),
                array(
                    'id'    => 'bop_book_rating',
                    'type'  => 'slider',
                    'title' => __('Ratings', 'bookify-pro'),
                    'min'     => 0,
                    'max'     => 5,
                    'step'    => 1,
                    'unit'    => 'px',
                    'default' => 4,
                ),
                array(
                    'id'    => 'bop_book_regular_price',
                    'type'  => 'text',
                    'title' => __('Book Regular Prices', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_sale_price',
                    'type'  => 'text',
                    'title' => __('Book Sale Prices', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_buy_button_text',
                    'type'  => 'text',
                    'title' => __('Buy Button Text', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_buy_button_link',
                    'type'  => 'text',
                    'title' => __('Buy Button Link', 'bookify-pro'),
                ),
                array(
                    'id'        => 'bop_book_multiple_purchase_link',
                    'type'      => 'repeater',
                    'title'     => 'Book Multiple Purchase Link',
                    'fields'    => array(


                        array(
                            'id'    => 'bop_website_icon_or_image',
                            'type'  => 'button_set',
                            'title' => 'Website Icon/Image',
                            'options'    => array(
                                'icon'  => __('Icon', 'bookify-pro'),
                                'image' => __('Image', 'bookify-pro'),
                            ),
                            'default'    => 'icon'
                        ),

                        array(
                            'id'    => 'bop_website_icon',
                            'type'  => 'icon',
                            'title' => 'Website Icon',
                            'dependency' => array('bop_website_icon_or_image', '==', 'icon')
                        ),
                        array(
                            'id'    => 'bop_website_image',
                            'type'    => 'media',
                            'title' => 'Website Image Icon',
                            'preview' => false,
                            'dependency' => array('bop_website_icon_or_image', '==', 'image')
                        ),
                        array(
                            'id'    => 'bop_website_link',
                            'type'  => 'text',
                            'title' => 'Website Name & Book Link',
                        ),
                    ),
                ),
            )
        ));
    }
}
