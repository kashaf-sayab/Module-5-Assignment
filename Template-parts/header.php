<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> style="color: <?php echo get_theme_mod('header_text_color', '#000000'); ?>;">
    <?php wp_body_open(); ?>
    <header style="background-color: <?php echo get_theme_mod('header_background_color', '#ffffff'); ?>;">
        <div class="header-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<span>' . get_bloginfo('name') . '</span>';
                }
                ?>
            </a>
        </div>

        <div class="header-right">
            <nav class="header-nav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class'     => '',
                    'container'      => false,
                ));
                ?>
            </nav>

            <div class="search-bar">
                <form role="search" method="get" action="<?php echo home_url('/'); ?>">
                    <input type="search" name="s" placeholder="<?php echo get_theme_mod('search_placeholder_text', ''); ?>">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
    </header>
    <main class="site-main">