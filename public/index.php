<?php
/**
 * Copyright (c) 2017.
 * Developed by Brainson GmbH.
 *
 * @package Brainson/HTML5-Reset-Theme-Wordpress
 * @author Holger Sielaff <holger.sielaff@brainson.de>
 * @see https://www.brainson.de/
 *
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/** Loads the WordPress Environment and Template */
define('WP_USE_THEMES', true);
require __DIR__ . '/wp/wp-blog-header.php';
