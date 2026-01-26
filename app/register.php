<?php
require 'db.php';
session_start();

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($email === '' || $password === '') {
        $error = 'Заповни всі поля, не будь ледачим';
    } else {
        // check if user exists
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);

        if ($stmt->fetch()) {
            $error = 'Такий юзер вже є. Не прикидайся новеньким 😉';
        } else {
            // create user
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare(
                    'INSERT INTO users (email, password) VALUES (:email, :password)'
            );

            $stmt->execute([
                    'email' => $email,
                    'password' => $hash
            ]);

            header('Location: login.php');
            exit;
        }
    }
}
?>


<?php
include __DIR__ . '/includes/header.php';
?>
    <h1 class="text-center mb-4">Registration</h1>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger text-center">
                                <?= htmlspecialchars($error) ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input
                                        name="email"
                                        type="email"
                                        class="form-control"
                                        id="email"
                                        placeholder="Email"
                                        required
                                >
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input
                                        name="password"
                                        type="password"
                                        class="form-control"
                                        id="password"
                                        placeholder="Password"
                                        required
                                >
                            </div>

                            <button type="submit" class="btn btn-success w-100">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
include __DIR__ . '/includes/footer.php';
?>