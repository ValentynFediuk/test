<?php
require 'db.php';
global $pdo;
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = (int)$_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
            "UPDATE posts SET title=:title, content=:content WHERE id=:id"
    );
    $stmt->execute([
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'id' => $id
    ]);
    header("Location: /");
    exit;
}

$post = $pdo->prepare("SELECT * FROM posts WHERE id=:id");
$post->execute(['id' => $id]);
$post = $post->fetch();
?>

<?php include __DIR__ . '/includes/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title mb-4">Edit Your Note</h2>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input
                                    type="text"
                                    name="title"
                                    id="title"
                                    class="form-control"
                                    value="<?= htmlspecialchars($post['title']) ?>"
                                    required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea
                                    name="content"
                                    id="content"
                                    class="form-control"
                                    rows="6"
                                    required
                            ><?= htmlspecialchars($post['content']) ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
