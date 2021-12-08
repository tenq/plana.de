<?php get_header(); ?>

    <main id="main">
        <div class="o-container" itemprop="mainContentOfPage">
            <h1><?php echo __('Tag Archive:', THEME_DOMAIN) . ' ' . single_tag_title('', false); ?></h1>

            <?php get_template_part('loop'); ?>
        </div>
    </main>

<?php get_footer(); ?>
