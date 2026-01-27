<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>
<body class="position-relative">
<?php
// Get current page name once
$page = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
?>

<header class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">


            <a id="brand-logo" class="navbar-brand fw-bold" href="/">
                <i class="fa-regular fa-note-sticky"></i>
                Notes App
            </a>

            <div class="d-flex gap-2">
                <?php if (!in_array($page, ['login.php', 'register.php'])): ?>
                    <a href="logout.php" class="btn btn-outline-light btn-sm">
                        Logout
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </a>
                <?php endif; ?>

                <?php if ($page === 'register.php'): ?>
                    <a href="login.php" class="btn btn-outline-light btn-sm">
                        Login
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    </a>
                <?php endif; ?>

                <?php if ($page === 'login.php'): ?>
                    <a href="register.php" class="btn btn-outline-light btn-sm">
                        <i class="fa-solid fa-user-plus"></i>
                        Register
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>
