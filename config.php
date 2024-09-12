<?php

return [
    'site_name' => 'MiniPHP Demo',
    'site_url' => 'https://miniphp-demo.example.com/',
    'author' => 'MiniPHP Team',
    'github' => 'https://github.com/namankumar80510/miniphp',
    'site_image' => '/images/miniphp-banner.webp',
    'logo' => '/images/miniphp-logo.png',

    'featured_content' => [
        'title' => 'Welcome to MiniPHP',
        'description' => 'A lightweight PHP framework for building web applications quickly and efficiently.',
        'url' => '/',
    ],

    'header_menu' => [
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Documentation', 'url' => '/docs/'],
        ['name' => 'Tutorials', 'url' => '/tutorials/'],
        ['name' => 'API', 'url' => '/api/'],
    ],

    'footer_menu' => [
        ['name' => 'About', 'url' => '/about/'],
        ['name' => 'Contact', 'url' => '/contact/'],
    ],

    'sidebar_menu' => [
        ['name' => 'Getting Started', 'url' => '/docs/getting-started/'],
        ['name' => 'Core Concepts', 'url' => '/docs/core-concepts/'],
        ['name' => 'Advanced Topics', 'url' => '/docs/advanced/'],
    ],

    'social_menu' => [
        ['name' => 'GitHub', 'url' => 'https://github.com/miniphp/miniphp'],
        ['name' => 'Twitter', 'url' => 'https://twitter.com/miniphp'],
        ['name' => 'Discord', 'url' => 'https://discord.gg/miniphp'],
    ],
];