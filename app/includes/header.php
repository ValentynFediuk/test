<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP + Bootstrap + GSAP</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.jpg">
    <link rel="stylesheet" href="css/main.css">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
<header>
    <h1 class="text-blue-700">Notes App</h1>
    <?php
    $page = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

    if (!in_array($page, ['login.php', 'register.php'])) {
        echo '<a href="logout.php"><button>Logout</button></a>';
    }
    ?>

    <?php
    $page = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

    if ($page === 'register.php') {
        echo '<a href="login.php"><button>Login</button></a>';
    }
    ?>

    <?php
    $page = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

    if ($page === 'login.php') {
        echo '<a href="register.php"><button>Register</button></a>';
    }
    ?>

</header>