<?php
/**
 * All ajax requests.
 *
 * @package player-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


if ( !class_exists( 'Player_theme_request_ajax' ) ) {
    class Player_theme_request_ajax {
        public static function init() {
            // Pagination home
            add_action( 'wp_ajax_paginationHome',  array( __CLASS__, 'paginationHome' ) );
            add_action( 'wp_ajax_nopriv_paginationHome', array( __CLASS__, 'paginationHome' ) );

            // Example
            add_action( 'wp_ajax_example',  array( __CLASS__, 'example' ) );
            add_action( 'wp_ajax_nopriv_example', array( __CLASS__, 'example' ) );
        }

        public static function  example() {
            echo "Hola mundo";
            wp_die();
        }

        public static function paginationHome() {
            $jsondata = array();
            $paged = $_POST['paged'];
            $query = new WP_Query( array(
                'paged' => $paged,
                'post_type' => 'post'
            ) );
            $GLOBALS['wp_query'] = $query;
            $jsondata['posts'] = array();
            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    $query->the_post();
                    $post = array();
                    $post['has_post_thumbnail'] = has_post_thumbnail();
                    $post['the_post_thumbnail_url'] = get_the_post_thumbnail_url( $post->ID, 'player-theme-loop' );
                    $post['the_thumbnail_default'] = get_bloginfo( 'stylesheet_directory' ) . '/img/no-cover-image.png';
                    $post['the_permalink'] = get_the_permalink();
                    $post['the_id'] = get_the_id();
                    $post['the_title'] = get_the_title();
                    $post['the_author'] = get_the_author();
                    $post['the_date'] =get_the_date( 'l, F j, Y' );
                    array_push( $jsondata['posts'], $post);
                }
            } else {

            }
            echo json_encode($jsondata);
            wp_die();
        }
    }
}

Player_theme_request_ajax::init();