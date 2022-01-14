<?php

$page_404_id = get_field('404_page', 'option');

add_filter( 'wp_title', function($title){
    $page_404 = get_post(get_field('404_page', 'option'));
//    return $page_404->post_title;
} );



$context = Timber::context();
$context['post'] = new Timber\Post($page_404_id);
Timber::render('templates/single.twig', $context);

