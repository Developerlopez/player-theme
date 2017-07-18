<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package player-theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="<?php if ( is_single() ) {
        single_post_title('', true);
    } else {
        bloginfo('name'); echo " - "; bloginfo('description');
    }
    ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="player-theme">
		<header class="main-header">
			<div class="container">
				<div class="row">
					<div class="col-12 col-md-6 site-branding">
						<?php $custom_logo_id = get_theme_mod( 'custom_logo' );
						if ( $custom_logo_id ) {
							$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
							echo '<img src="' .$image[0] . '" class="the-logo">';
						} else {
							echo '<h1 class="the-name">' . get_bloginfo( 'name' ) . '</h1>';
						} ?>
						<h2 class="hidden-xs the-description"><?php bloginfo( 'description' ); ?></h2>
					</div>
					<div class="col-12 col-md-6 hidden-xs search-widget">
						<form class="main-search">
							<input type="search" name="main-search" placeholder="Search by Artist - Song" class="search-input">
							<input type="submit" value="Search" class="submit-input">
						</form>
					</div>
				</div>
			</div>
            <button class="toggle-top-menu" v-on:click="showTopMenu = !showTopMenu"><i class="fa fa-bars" aria-hidden="true"></i></button>
		</header>
        <transition name="fade">
            <nav v-show="showTopMenu" class="container hidden-xs main-navigation">
                <div class="row">
                    <ul class="top-menu">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#">Sample</a></li>
                        <li><a href="#">Other page</a></li>
                    </ul>
                </div>
            </nav>
        </transition>
	</div>
