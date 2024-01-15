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
                    'id'    => 'pop_original_book_name',
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
            )
        ));
    }
}
