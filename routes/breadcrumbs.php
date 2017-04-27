<?php

Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', route('home'));
});

Breadcrumbs::register('document.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Document/Show/'. $id, route('document.show', $id));
});
