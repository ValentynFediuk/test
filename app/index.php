<?php

require 'db.php';
global $pdo;

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// ==========================
// CREATE POST
// ==========================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
            "INSERT INTO posts (title, content, user_id) VALUES (:t, :c, :u)"
    );
    $stmt->execute([
            't' => $_POST['title'],
            'c' => $_POST['content'],
            'u' => $_SESSION['user_id']
    ]);
    header("Location: /");
    exit;
}

// ==========================
// READ POSTS WITH FILTER
// ==========================
$sql = "SELECT * FROM posts WHERE user_id = :uid";
$where = [];
$params = ['uid' => $_SESSION['user_id']];

// Filter by period
if (!empty($_GET['period'])) {
    if ($_GET['period'] === 'today') {
        $where[] = "created_at >= CURRENT_DATE";
    } elseif ($_GET['period'] === 'week') {
        $where[] = "created_at >= NOW() - INTERVAL '7 days'";
    } elseif ($_GET['period'] === 'month') {
        $where[] = "created_at >= NOW() - INTERVAL '30 days'";
    }
}

// Add period condition if exists
if ($where) {
    $sql .= " AND " . implode(" AND ", $where);
}

$sql .= " ORDER BY created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$posts = $stmt->fetchAll();

?>
<?php include __DIR__ . '/includes/header.php'; ?>

    <h1 class="text-center mb-4">Create Your Note</h1>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- CREATE NOTE FORM -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input
                                        name="title"
                                        type="text"
                                        class="form-control"
                                        id="title"
                                        placeholder="Title"
                                        required
                                >
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea
                                        name="content"
                                        class="form-control"
                                        id="content"
                                        rows="5"
                                        placeholder="Content"
                                        required
                                ></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Create</button>
                        </form>
                    </div>
                </div>

                <!-- FILTER FORM -->
                <form method="GET" class="d-flex mb-4 gap-2 align-items-center">
                    <select name="period" class="form-select w-auto">
                        <option value="">All time</option>
                        <option value="today" <?= ($_GET['period'] ?? '') === 'today' ? 'selected' : '' ?>>Today</option>
                        <option value="week" <?= ($_GET['period'] ?? '') === 'week' ? 'selected' : '' ?>>Last 7 days</option>
                        <option value="month" <?= ($_GET['period'] ?? '') === 'month' ? 'selected' : '' ?>>Last 30 days</option>
                    </select>
                    <button type="submit" class="btn btn-secondary">Filter</button>
                </form>

                <!-- POSTS LIST -->
                <h2 class="mb-3">Posts List</h2>
                <?php foreach ($posts as $post): ?>
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                Date created: <?= date('d.m.Y H:i', strtotime($post['created_at'])) ?>
                            </h6>
                            <p class="card-text"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                            <div class="d-flex gap-2">
                                <a href="edit.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-primary">✏️ Edit</a>
                                <a href="delete.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete нахуй?')">🗑 Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>


<?php include __DIR__ . '/includes/footer.php'; ?>