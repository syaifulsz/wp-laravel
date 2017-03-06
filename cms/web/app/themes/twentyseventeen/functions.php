<?php

add_theme_support( 'post-thumbnails' );

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

        .editor-preview pre kbd,
        .editor-preview pre code,
        .editor-preview-side pre kbd,
        .editor-preview-side pre code
        {
            background: none!important;
        }

    </style>
    ";
}

function enqueue_custom_admin_style() {
        wp_register_style( 'wp_admin_css__font_droid_sans', 'https://fonts.googleapis.com/css?family=Droid+Sans', false, '1.0.0' );
        wp_enqueue_style( 'wp_admin_css__font_droid_sans' );
}
add_action( 'admin_enqueue_scripts', 'enqueue_custom_admin_style' );

// function my_project_updated_send_email( $post_id ) {
//
// 	// If this is just a revision, don't send the email.
// 	if ( wp_is_post_revision( $post_id ) )
// 		return;
//
// 	$post_title = get_the_title( $post_id );
// 	$post_url = get_permalink( $post_id );
// 	$subject = 'A post has been updated';
//
// 	$message = "A post has been updated on your website:\n\n";
// 	$message .= $post_title . ": " . $post_url;
//
// }
// add_action( 'save_post', 'my_project_updated_send_email' );