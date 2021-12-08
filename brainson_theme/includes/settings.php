<?php

if (function_exists('acf_add_options_page')) {
    acf_add_options_page([
        'page_title' => __('Scaffold'),
        'menu_title' => __('Scaffold'),
        'icon_url' => 'dashicons-art'
    ]);

    acf_add_local_field_group([
        'key' => 'group_theme_settings',
        'title' => 'Scaffold',
        'fields' => [
            [
                'key' => 'field_productive',
                'label' => 'Produktivmodus',
                'name' => 'productive',
                'type' => 'true_false',
            ],
            [
                'key' => 'field_5fbfa92ac1105',
                'label' => '404 Seite',
                'name' => '404_page',
                'type' => 'post_object',
                'instructions' => 'Die Inhalte der hier eingestellten Seite werden auf der 404-Seite angezeigt. Die Seite sollte auf privat gestellt sein.',
                'required' => 0,
                'post_type' => array(
                    0 => 'page',
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'return_format' => 'id',
                'ui' => 1,
            ]
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-scaffold',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'acf_after_title',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ]);
}

if( function_exists('acf_add_local_field_group') ) {

    acf_add_local_field_group([
        'key' => 'group_6172a26895d04',
        'title' => 'Post Textauszug',
        'fields' => [
            [
                'key' => 'field_6172a2764d6e6',
                'label' => 'Post Textauszug',
                'name' => 'post_excerpt',
                'type' => 'textarea',
                'instructions' => 'Wird auf Kategorie Seite angezeigt.',
                'required' => 1,
                'conditional_logic' => 0,
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'new_lines' => '',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ]);

    acf_add_local_field_group([
        'key' => 'group_616051c2d0fcc',
        'title' => 'Inhalt Elemente',
        'fields' => [
            [
                'key' => 'field_616051cf03fe0',
                'label' => 'Inhalt Elemente',
                'name' => 'content',
                'type' => 'group',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key' => 'field_61605277dde54',
                        'label' => 'Titel',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ],
                    [
                        'key' => 'field_616053b2dde55',
                        'label' => 'Einleitungstext',
                        'name' => 'intro',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'default_value' => '',
                        'placeholder' => '',
                        'maxlength' => '',
                        'rows' => '',
                        'new_lines' => 'wpautop',
                    ],
                    [
                        'key' => 'field_616054addde56',
                        'label' => 'Header Image',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'return_format' => 'id',
                        'preview_size' => 'medium',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => 'category',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ]);
}
