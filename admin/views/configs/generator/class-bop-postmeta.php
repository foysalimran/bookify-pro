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
                    'id'    => 'bop_original_book_name',
                    'type'  => 'text',
                    'title' => __('Original Book Name', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_original_book_url',
                    'type'  => 'text',
                    'title' => __('Original Book URL', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_name',
                    'type'  => 'text',
                    'title' => __('Book Name', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_publish_date',
                    'type'  => 'date',
                    'title' => __('Publish Date', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_publisher_name',
                    'type'  => 'text',
                    'title' => __('Publisher Name', 'bookify-pro'),
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
                    'id'    => 'bop_book_format',
                    'type'  => 'text',
                    'title' => __('Book Format', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_page',
                    'type'  => 'text',
                    'title' => __('Book Pages', 'bookify-pro'),
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
                    'id'    => 'bop_book_translator_name',
                    'type'  => 'text',
                    'title' => __('Translator Name', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_dimension',
                    'type'  => 'text',
                    'title' => __('Dimension', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_weight',
                    'type'  => 'text',
                    'title' => __('Weight', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_file_size',
                    'type'  => 'text',
                    'title' => __('File size (If Ebook)', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_simultaneous_device',
                    'type'  => 'text',
                    'title' => __('Simultaneous device usage', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_file_format',
                    'type'  => 'text',
                    'title' => __('File Format (If Ebook)', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_asin',
                    'type'  => 'text',
                    'title' => __('ASIN', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_speech',
                    'type'  => 'select',
                    'placeholder'   => __('Choose an option', 'bookify-pro'),
                    'title' => __('Text To Speech', 'bookify-pro'),
                    'options' => array(
                        'enabled' => __('Enabled', 'bookify-pro'),
                        'not_enabled' => __('Not Enabled', 'bookify-pro'),
                    )
                ),
                array(
                    'id'    => 'bop_book_screen_reader',
                    'type'  => 'select',
                    'placeholder'   => __('Choose an option', 'bookify-pro'),
                    'title' => __('Screen Reader', 'bookify-pro'),
                    'options' => array(
                        'enabled' => __('Enabled', 'bookify-pro'),
                        'not_enabled' => __('Not Enabled', 'bookify-pro'),
                    )
                ),
                array(
                    'id'    => 'bop_book_enhanced_typesetting',
                    'type'  => 'select',
                    'placeholder'   => __('Choose an option', 'bookify-pro'),
                    'title' => __('Enhanced typesetting', 'bookify-pro'),
                    'options' => array(
                        'enabled' => __('Enabled', 'bookify-pro'),
                        'not_enabled' => __('Not Enabled', 'bookify-pro'),
                    )
                ),
                array(
                    'id'    => 'bop_book_x_ray',
                    'type'  => 'select',
                    'placeholder'   => __('Choose an option', 'bookify-pro'),
                    'title' => __('X-Ray', 'bookify-pro'),
                    'options' => array(
                        'enabled' => __('Enabled', 'bookify-pro'),
                        'not_enabled' => __('Not Enabled', 'bookify-pro'),
                    )
                ),
                array(
                    'id'    => 'bop_book_word_wise',
                    'type'  => 'select',
                    'placeholder'   => __('Choose an option', 'bookify-pro'),
                    'title' => __('Word Wise', 'bookify-pro'),
                    'options' => array(
                        'enabled' => __('Enabled', 'bookify-pro'),
                        'not_enabled' => __('Not Enabled', 'bookify-pro'),
                    )
                ),
                array(
                    'id'    => 'bop_book_sticky_notes',
                    'type'  => 'text',
                    'title' => __('Sticky Notes', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_print_length',
                    'type'  => 'text',
                    'title' => __('Print Length', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_availability_status',
                    'type'  => 'select',
                    'title' => __('Book Availability Status', 'bookify-pro'),
                    'placeholder' => __('Choose an option', 'bookify-pro'),
                    'options' => array(
                        'available'  => __('Available', 'bookify-pro'),
                        'upcoming'  => __('Upcoming', 'bookify-pro'),
                    )
                ),
                array(
                    'id'    => 'bop_book_average_rating',
                    'type'  => 'select',
                    'placeholder' => __('Rate This Book', 'bookify-pro'),
                    'title' => __('Average Book Rating', 'bookify-pro'),
                    'options' => array(
                        '5' => __('5 Start', 'bookify-pro'),
                        '4.5' => __('4.5 Start', 'bookify-pro'),
                        '4' => __('4 Start', 'bookify-pro'),
                        '3.5' => __('3.5 Start', 'bookify-pro'),
                        '3' => __('3 Start', 'bookify-pro'),
                        '2.5' => __('2.5 Start', 'bookify-pro'),
                        '2' => __('2 Start', 'bookify-pro'),
                        '1.5' => __('1.5 Start', 'bookify-pro'),
                        '1' => __('1 Start', 'bookify-pro'),
                    )
                ),
                array(
                    'id'    => 'bop_book_total_rating',
                    'type'  => 'text',
                    'title' => __('Total Book Ratings', 'bookify-pro'),
                ),
                array(
                    'id'    => 'bop_book_rating_link',
                    'type'  => 'text',
                    'title' => __('Book Rating Links', 'bookify-pro'),
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
                            'title' => 'Website Name & Book Link',
                            'dependency' => array('bop_website_icon_or_image', '==', 'icon')
                        ),
                        array(
                            'id'    => 'bop_website_image',
                            'type'    => 'media',
                            'title' => 'Website Name & Book Link',
                            'preview' => false,
                            'dependency' => array('bop_website_icon_or_image', '==', 'image')
                        ),
                        array(
                            'id'    => 'bop_website_link',
                            'type'  => 'link',
                            'title' => 'Website Name & Book Link',
                        ),

                    ),
                ),
            )
        ));
    }
}
