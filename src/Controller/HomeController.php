<?php

declare(strict_types=1);

namespace App\Controller;

class HomeController
{
    /**
     * Handles the index page of the application.
     *
     * This method checks if the user is logged in and redirects to the dashboard if true.
     * Otherwise, it renders the home page with a title, description, and a list of articles.
     *
     * @return void
     */
    public function index()
    {
        render('home/index', [
            'title' => 'Home',
            'description' => 'Welcome to the home page',
            'articles' => [
                ['slug' => 'introduction-to-miniphp', 'title' => 'Introduction to MiniPHP'],
                ['slug' => 'building-your-first-app', 'title' => 'Building Your First App with MiniPHP'],
                ['slug' => 'advanced-routing-techniques', 'title' => 'Advanced Routing Techniques in MiniPHP'],
            ]
        ]);
    }
}
