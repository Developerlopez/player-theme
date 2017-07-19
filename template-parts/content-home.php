<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package player-theme
 */

?>

<?php global $post;
global $wp_query;
$current_post = $wp_query->current_post + 1;
$post_count = $wp_query->post_count - $current_post; ?>
<div class="row posts-row">
    <div class="col-xl-12 post">
        <figure class="to-left featured-image">
            <?php if (has_post_thumbnail()) {
                $featured_img_url = get_the_post_thumbnail_url($post->ID, 'player-theme-loop');
                echo '<img src="' . $featured_img_url . '" alt="' . get_the_title() . '" />';
            } else {
                echo '<img src="' . get_bloginfo('stylesheet_directory') . '/img/no-cover-image.png" />';
            } ?>
        </figure>
        <div class="to-left summary-post">
            <div class="title-post">
                <h2><a href="<?php echo get_the_permalink(); ?>"
                       data-id="<?php echo get_the_id(); ?>"><?php echo get_the_title(); ?></a></h2>
            </div>
            <div class="author-post">
                <p><i class="fa fa-user" aria-hidden="true"></i> <?php echo get_the_author(); ?></p>
            </div>
            <div class="date-post">
                <p><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo get_the_date('l, F j, Y'); ?></p>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

