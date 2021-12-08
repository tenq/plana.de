<?php get_header(); ?>

    <main id="main">
        <div class="o-container" itemprop="mainContentOfPage">
            <h1><?php _e('Latest Posts', THEME_DOMAIN); ?></h1>

            <?php get_template_part('loop'); ?>
        </div>
    </main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
