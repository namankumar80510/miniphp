<h1>Welcome to MiniPHP</h1>

<p>MiniPHP is a simple PHP framework built for experimentation and learning purposes.</p>

<h2>Features</h2>
<ul>
    <li>Lightweight and easy to understand</li>
    <li>Basic routing system</li>
    <li>Simple templating engine</li>
    <li>Environment variable support</li>
</ul>

<h2>Getting Started</h2>
<p>To get started with MiniPHP, check out our <a href="/docs">documentation</a> or visit the <a href="https://github.com/yourusername/miniphp">GitHub repository</a>.</p>

<h2>Recent Articles</h2>

<?php foreach ($articles as $article): ?>
    <h3><a href="/articles/<?= esc($article['slug']) ?>"><?= esc($article['title']) ?></a></h3>
<?php endforeach; ?>
