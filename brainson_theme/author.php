<?php get_header(); ?>

	<div id="main">
		<div class="o-container" itemprop="mainContentOfPage">

		<?php if (have_posts()): the_post(); ?>

			<h1><?php echo __('Author Archives for', THEME_DOMAIN) . ' ' . get_the_author(); ?></h1>

		<?php if (get_the_author_meta('description')) : ?>

		<?php echo get_avatar(get_the_author_meta('user_email')); ?>

			<h2><?php echo __('About', THEME_DOMAIN) . ' ' . get_the_author(); ?></h2>

			<?php echo wpautop(get_the_author_meta('description')); ?>

		<?php endif; ?>

		<?php rewind_posts(); while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if (has_post_thumbnail()) : // Check if Thumbnail exists?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php the_post_thumbnail([120, 120]); // Declare pixel size you need inside the array?>
					</a>
				<?php endif; ?>

				<h2>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
				</h2>

				<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
				<span class="author"><?php _e('Published by', THEME_DOMAIN); ?> <?php the_author_posts_link(); ?></span>
				<span class="comments"><?php comments_popup_link(__('Leave your thoughts', THEME_DOMAIN), __('1 Comment', THEME_DOMAIN), __('% Comments', THEME_DOMAIN)); ?></span>

				<br class="clear">

				<?php edit_post_link(); ?>

			</article>

		<?php endwhile; ?>

		<?php else: ?>

			<article>

				<h2><?php _e('Sorry, nothing to display.', THEME_DOMAIN); ?></h2>

			</article>

		<?php endif; ?>

		</div>
	</div>

<?php get_footer(); ?>
