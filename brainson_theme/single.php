
<?php

wp_reset_query();
$context = Timber::context();

if (!is_front_page()) {
    $context['breadcrumb'] = (new Breadcrumb([
        'structure' => Breadcrumb::STRUCTURE_PAGE,
        'always_home' => true
    ]))->render();
}
$context['post_image'] = get_post_thumbnail_id();
Timber::render('templates/single.twig', $context);
