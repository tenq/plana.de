<?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php if (has_post_thumbnail()) : // Check if thumbnail exists?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_post_thumbnail([120, 120]); // Declare pixel size you need inside the array?>
            </a>
        <?php endif; ?>

        <h2>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        </h2>

        <span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
        <span class="author"><?php _e('Published by', THEME_DOMAIN); ?> <?php the_author_posts_link(); ?></span>

        <?php edit_post_link(); ?>

    </article>

<?php endwhile; ?>

<?php else: ?>

    <article>
        <h2><?php _e('Sorry, nothing to display.', THEME_DOMAIN); ?></h2>
    </article>

<?php endif; ?>
