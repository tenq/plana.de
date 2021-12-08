<?php

$context = Timber::context();

if (!is_front_page()) {
    $context['breadcrumb'] = (new Breadcrumb([
        'structure' => Breadcrumb::STRUCTURE_PAGE,
        'always_home' => true
    ]))->render();
}

Timber::render('templates/page.twig', $context);
