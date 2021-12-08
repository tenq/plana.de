<form class="search" method="get" action="<?php echo home_url(); ?>" role="search" itemscope itemtype="http://schema.org/SearchAction">
    <meta itemprop="target" content="<?php echo home_url(); ?>?s={query}">
	<input class="search-input" type="search" name="s" placeholder="<?php _e('To search, type and hit enter.', THEME_DOMAIN); ?>" itemprop="query-input">
	<button class="search-submit" type="submit" role="button"><?php _e('Search', THEME_DOMAIN); ?></button>
</form>
