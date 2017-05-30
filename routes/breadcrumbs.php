<?php

Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('ilawee.vn', route('home'));
});

Breadcrumbs::register('vanban.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Vanban/'. $id, route('vanban.show', $id));
});
