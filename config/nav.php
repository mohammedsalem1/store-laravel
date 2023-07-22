<?php
return [
    [
        'icon'   => 'nav-icon fas fa-tachometer-alt',
        'route'  => 'dashboard.dashboard',
        'title'  => 'Dashboard' ,
        'active' => 'dashboard.dashboard'
    ] ,
    [
        'icon'  => 'far fa-circle nav-icon',
        'route' => 'dashboard.categories.index',
        'title' => 'Categories' ,
        'badge' => 'New' ,
        'active' => 'dashboard.categories.*'
    ] ,
    [
        'icon'  => 'far fa-circle nav-icon',
        'route' => 'dashboard.categories.index',
        'title' => 'Products' ,
        'active' => 'dashboard.product'
    ] ,
    [
        'icon'  => 'far fa-circle nav-icon',
        'route' => 'dashboard.categories.index',
        'title' => 'Order' ,
        'active' => 'dashboard.order'
    ] ,
];
