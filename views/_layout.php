<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'MiniPHP') ?></title>
    <meta name="description" content="<?= esc($description ?? 'A simple PHP framework') ?>">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background-color: #f4f4f4;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 10px;
        }
        nav ul li a {
            text-decoration: none;
            color: #333;
        }
        main {
            background-color: #fff;
            padding: 1rem;
        }
        footer {
            text-align: center;
            margin-top: 1rem;
            padding: 1rem;
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <header>
        <h1>MiniPHP</h1>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?= $content ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> MiniPHP. All rights reserved.</p>
    </footer>
</body>
</html>
