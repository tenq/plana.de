<?php get_header(); ?>

    <main id="main">
        <div class="o-container">
            <h1><?php echo sprintf(__('%s Search Results for', THEME_DOMAIN), $wp_query->found_posts) . ' ' . get_search_query(); ?></h1>

            <?php get_template_part('loop'); ?>

            <?php get_template_part('pagination'); ?>
        </div>
    </main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
