<?php

add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
    echo "
    <style>
        .CodeMirror pre {
            padding-top: 3px;
            padding-bottom: 3px;
            padding-left: 4px;
            padding-right: 4px;
        }

        .CodeMirror .CodeMirror-code .cm-comment {
            font-family: 'Droid Sans', sans-serif;
            font-size: 14px;
            color: #555555;
        }
    </style>
    ";
}

function enqueue_custom_admin_style() {
        wp_register_style( 'wp_admin_css__font_droid_sans', 'https://fonts.googleapis.com/css?family=Droid+Sans', false, '1.0.0' );
        wp_enqueue_style( 'wp_admin_css__font_droid_sans' );
}
add_action( 'admin_enqueue_scripts', 'enqueue_custom_admin_style' );