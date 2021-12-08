<?php

// use Timber\Timber;

wp_reset_query();
$context = Timber::context();

$context['breadcrumb'] = (new Breadcrumb([
    'structure' => Breadcrumb::STRUCTURE_PAGE,
    'with_categories' => true,
    'always_home' => true
]))->render();

$category = get_queried_object();
$context['content'] = $categoryContent = get_field('content', $category);

if ($categoryContent && $categoryContent['image'])
{
    $context['heroImage'] = $categoryContent['image'];
}

global $paged;

if (!isset($paged) || !$paged)
{
    $paged = 1;
}

$categoryId = $category->cat_ID;
$posts_per_page = 5;
$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'numberposts' => -1,
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
    'category' => $categoryId,
    'orderby' => array(
        'date' => 'DESC'
    )
);

$posts = new Timber\PostQuery($args);

$context['categoryItems'] = $posts;


Timber::render('templates/category.twig', $context);

?>