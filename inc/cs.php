<?php

// Control core classes for avoid errors
if (class_exists('CSF')) {

    //
    // Set a unique slug-like ID
    $prefix = 'custom_admin';

    //
    // Create options
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
}


