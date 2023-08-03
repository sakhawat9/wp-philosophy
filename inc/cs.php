<?php

// Control core classes for avoid errors
if (class_exists('CSF')) {

    //
    // Set a unique slug-like ID
    $prefix = 'custom_admin';

    //
    // Create Meta box
    CSF::createMetabox($prefix, array(
        'title' => 'Custom Admin',
        'post_type' => 'page',
    ));

    //
    // Create a section
    CSF::createSection($prefix, array(
        'title'  => 'Contact Form test',
        'fields' => array(

            //
            // A text field
            array(
                'id'    => 'opt-text',
                'type'  => 'text',
                'title' => __('Name', 'philosophy'),
            ),
            array(
                'id'       => 'opt-email',
                'type'     => 'text',
                'title'    => 'Email validate',
                'subtitle' => 'This text field only allows validated email address.',
                // 'default'  => 'info@domain.com test',
                'validate' => 'csf_validate_email',
            ),
            array(
                'id'    => 'opt-textarea',
                'type'  => 'textarea',
                'title' => 'Simple Textarea',
            ),
            array(
                'id'    => 'is-favorite',
                'type'  => 'switcher',
                'title' => __('Is Favorite', 'philosophy'),
                'default' => 1
            ),
            // 01 System
            // array(
            //     'id'    => 'is-favorite-extra',
            //     'type'  => 'switcher',
            //     'title' => __( 'Extra Check', 'philosophy' ),
            //     'default'=> 0
            // ),
            // array(
            //     'id'    => 'page-favorite-text',
            //     'type'  => 'text',
            //     'title' => __( 'Favorite Text', 'philosophy' ),
            //     'dependency'=> array('is-favorite|is-favorite-extra', '==|==', '1|1')
            // ),
            // 02 System
            array(
                'id'    => 'is-favorite-extra',
                'type'  => 'switcher',
                'title' => __('Extra Check', 'philosophy'),
                'default' => 0,
                'dependency' => array('is-favorite', '==', '1')
            ),
            array(
                'id'    => 'is-favorite-extra',
                'type'  => 'text',
                'title' => __('Favorite Text', 'philosophy'),
                'dependency' => array('is-favorite-extra', '==', '1')
            ),
            // Checkbox
            array(
                'id'    => 'support-language',
                'type'  => 'checkbox',
                'title' => __('Languages', 'philosophy'),
                'options' => array(
                    'bangla' => 'Bangla',
                    'english' => 'English',
                    'french' => 'French',
                ),
            ),
            array(
                'id'    => 'extra-language-data',
                'type'  => 'text',
                'title' => __('Extra Data', 'philosophy'),
                // 'dependency'=> array('support-language_bangla|support-language_english', '==|==', '1|1')
                'dependency' => array('support-language', 'any', 'bangla,english')
            ),
        )
    ));
    CSF::createSection($prefix, array(
        'title'  => 'Page upload metabox',
        'fields' => array(

            //
            // A text field
            array(
                'id'      => 'page-upload',
                'type'    => 'upload',
                'title'   => __('Upload PDF', 'philosophy'),
                'settings'      => array(
                    'upload_type'  => 'video/mp4',
                    'button_title' => __('Upload', 'philosophy'),
                    'frame_title'  => __('Select a PDF', 'philosophy'),
                    'insert_title' => __('Use this PDF', 'philosophy')
                ),
            ),
            array(
                'id'      => 'page-image',
                'type'    => 'image',
                'title'   => __('Upload Image', 'philosophy'),
                'add_title'   => __('Add An Image', 'philosophy'),
            ),
            array(
                'id'      => 'page-gallery',
                'type'    => 'gallery',
                'title'   => __('Upload Gallery', 'philosophy'),
                'add_title'   => __('Add Images', 'philosophy'),
                'edit_title'   => __('Edit Gallery', 'philosophy'),
                'clear_title'   => __('Clear Gallery', 'philosophy'),
            ),
            array(
                'id'        => 'fieldset_1',
                'type'      => 'fieldset',
                'title'     => 'Fieldset Field',
                'fields'    => array(

                    array(
                        'id'    => 'fieldset_1_text',
                        'type'  => 'text',
                        'title' => 'Text Field',
                    ),

                    array(
                        'id'    => 'fieldset_1_textarea',
                        'type'  => 'textarea',
                        'title' => 'Textarea Field',
                    ),

                ),
            ),

            array(
                'id'              => 'unique_option_901',
                'type'            => 'group',
                'title'           => 'Group Field',
                'button_title'    => 'Add New',
                'accordion_title' => 'Add New Field',
                'fields'          => array(
                    array(
                        'id'    => 'featured_posts',
                        'type'  => 'select',
                        'title' => 'select a book',
                        'options' => 'posts',
                        'query_args'     => array(
                            'post_type'    => 'book',
                            'posts_per_page' => -1,
                            'orderby'      => 'post_date',
                            'order'        => 'DESC',
                        ),
                    ),

                ),
            ),
            array(
                'id'      => 'cpt_type',
                'type'    => 'select',
                'title'   => 'select a custom post type',
                'options' => array(
                    'none'    => 'None',
                    'book'    => 'Book',
                    'chapter' => 'Chapter'
                )
            ),
        )
    ));
}



function philosophy_custom_post_types($options)
{
    if (class_exists('CSF')) {
        $prefix = 'custom_pos_type';

        $page_id = 0;
        if (isset($_REQUEST['post']) || isset($_REQUEST['post_ID'])) {
            $page_id = empty($_REQUEST['post_ID']) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
        }
        CSF::createSection($prefix, array(
            'title'  => 'Select post type',
            'fields' => array(

                array(
                    'id'      => 'cpt_type',
                    'type'    => 'select',
                    'title'   => 'select a custom post type',
                    'options' => array(
                        'none'    => 'None',
                        'book'    => 'Book',
                        'chapter' => 'Chapter'
                    )
                ),
            )
        ));
    }
    $page_meta_info = get_post_meta($page_id, 'page-custom_post_type', true);
    if (isset($page_meta_info['cpt_type']) && $page_meta_info['cpt_type'] == 'book') {
        CSF::createSection($prefix, array(
            'title'  => 'Options For Book',
            'fields' => array(
                array(
                    'name'   => 'page-section1',
                    //                'title'  => __( 'Post Type', 'philosophy' ),
                    'icon'   => 'fa fa-image',
                    'fields' => array(
                        array(
                            'id'    => 'option_book_text',
                            'type'  => 'text',
                            'title' => 'Some Book Info',
                        ),
                    )
                )
            )
        ));
    }

    return $options;
}
add_filter('cs_metabox_options', 'philosophy_custom_post_types');


// Control core classes for avoid errors
if (class_exists('CSF')) {

    //
    // Set a unique slug-like ID
    $options = 'custom_shortcodes';

    //
    // Create a shortcoder
    CSF::createShortcoder($options, array(
        'button_title' => 'Add Shortcode',
        'post_type' => 'page',
    ));

    //
    // A basic shortcode
    CSF::createSection($options, array(
        'title'     => 'Shortcode Basic 1',
        'view'      => 'normal', // View model of the shortcode. `normal` `contents` `group` `repeater`
        'shortcode' => 'gmap', // Set a unique slug-like name of shortcode.
        'fields'    => array(

            array(
                'id'    => 'place',
                'type'  => 'text',
                'title' => 'Place',
                'help' => 'Enter Place',
                'default' => 'Noter Dame collage'
            ),

            array(
                'id'    => 'width',
                'type'  => 'text',
                'title' => 'width',
                'default' => '100%',
            ),
            array(
                'id'    => 'height',
                'type'  => 'text',
                'title' => 'height',
                'default' => 500,
            ),
            array(
                'id'    => 'zoom',
                'type'  => 'text',
                'title' => 'zop',
                'default' => 14,
            ),

        )

    ));
}

// Control core classes for avoid errors
if (class_exists('CSF')) {

    //
    // Set a unique slug-like ID
    $prefix = 'taxonomy_options';

    //
    // Create taxonomy options
    CSF::createTaxonomyOptions($prefix, array(
        'id'  => 'language_featured_image',
        'taxonomy' => 'language', // The type of the database save options. `serialize` or `unserialize`
    ));

    //
    // Create a section
    CSF::createSection($prefix, array(
        'fields' => array(

            array(
                'id'    => 'feature-image',
                'type'  => 'image',
                'title' => 'Featured Image',
            ),
            array(
                'id'    => 'feature-text',
                'type'  => 'text',
                'title' => 'Featured Text',
            ),
        )
    ));
}
