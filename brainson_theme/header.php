<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <title><?php wp_title(''); ?><?php if (wp_title('', false)) {
    echo ' :';
} ?> <?php bloginfo('name'); ?></title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php bloginfo('description'); ?>">

        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
        <header class="header clear" itemscope itemtype="https://schema.org/WPHeader">
            <div class="o-container">
                <div class="logo">
                    <a href="<?php echo home_url(); ?>">
                        <?php
                        /**
                         * @link: http://toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script
                         */
                        ?>
                        <svg>
                            <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/dist/svg/sprite.svg#icon-logo"></use>
                        </svg>
                    </a>
                </div>

                <nav id="header-menu" class="nav" itemscope itemtype="https://schema.org/SiteNavigationElement">
                    <?php wp_nav_menu([
                        'theme_location' => 'header-menu',
                        'container' => 'div',
                        'menu_class' => 'menu-wrapper',
                        'echo' => true,
                        'items_wrap' => '<ul class="menu">%3$s</ul>',
                    ]); ?>
                </nav>
            </div>
        </header>
