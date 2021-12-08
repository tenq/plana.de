<?php get_header(); ?>

    <main id="main">
        <div class="o-container" itemprop="mainContentOfPage">
            <h1><?php _e('Archives', THEME_DOMAIN); ?></h1>

            <?php get_template_part('loop'); ?>
        </div>
    </main>

<?php get_footer(); ?>
