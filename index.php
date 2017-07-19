<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package player-theme
 */

get_header(); ?>
    <main class="container main-content" role="main">
        <div class="row">
            <div class="col-12">
                <section id="noAjax" class="home-content">
                    <?php if ( have_posts() ) :
                        /* Start the Loop */
                        while ( have_posts() ) : the_post();
                            get_template_part( 'template-parts/content', 'home' );
                        endwhile; ?>
                    <?php else:
                        get_template_part( 'template-parts/content', 'none' );
                    endif; ?>
                </section>
                <section v-if="showHomeContent" class="home-content">
                    <template v-for="(post, index) in homePosts">
                        <div  class="row posts-row">
                            <div class="col-xl-12 post">
                                <figure class="to-left featured-image">
                                    <img v-if="post.has_post_thumbnail" v-bind:src="post.the_post_thumbnail_url" alt="">
                                    <img v-else v-bind:src="post.the_thumbnail_default" alt="">
                                </figure>
                                <div class="to-left summary-post">
                                    <div class="title-post">
                                        <h2><a v-bind:href="post.the_permalink" v-bind:data-id="post.the_id">{{ post.the_title }}</a></h2>
                                    </div>
                                    <div class="author-post">
                                        <p><i class="fa fa-user" aria-hidden="true"></i> {{ post.the_author }}</p>
                                    </div>
                                    <div class="date-post">
                                        <p><i class="fa fa-calendar" aria-hidden="true"></i> {{ post.the_date }}</p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </template>
                </section>
                <navigation paged="<?php echo $page = get_query_var('paged'); ?>"
                            maxnumpages="<?php global $wp_query; echo $wp_query->max_num_pages; ?>"
                            v-on:changepage="getHomePosts($event)"></navigation>
            </div>
        </div>
    </main>
<?php
get_footer();
