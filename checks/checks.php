<?php
require_once '../includes/connect_to_db.php';
require_once '../includes/utils.php';
require_once "../includes/functions.php";

if($_SESSION['role']=='user'){
  header('Location:/PHP-Project/php_project-cafeteria/users/views/user-home.php');
}
NotAuthRedirectToLogin();
$pdo = connectToDB();
 
// Initialize filter variables
$dateFrom = $_GET['date_from'] ?? '';
$dateTo = $_GET['date_to'] ?? '';
$userId = $_GET['user_id'] ?? '';
 
// Fetch users for the dropdown
$usersStmt = $pdo->query("SELECT user_id, name FROM users ORDER BY name ASC");
$users = $usersStmt->fetchAll(PDO::FETCH_ASSOC);
 
// Build SQL query with optional filters
$sql = "SELECT users.user_id, users.name, SUM(order_total_price.total_price) AS total_spent
        FROM users
        JOIN orders ON users.user_id = orders.user_id
        JOIN order_total_price ON orders.order_id = order_total_price.order_id
        WHERE orders.status = 'completed'";
 
$params = [];
 
// Apply date filtering if both dates are set
if (!empty($dateFrom) && !empty($dateTo)) {
    $sql .= " AND orders.date BETWEEN ? AND ?";
    $params[] = $dateFrom;
    $params[] = $dateTo;
}
 
// Apply user filtering if a specific user is selected
if (!empty($userId)) {
    $sql .= " AND users.user_id = ?";
    $params[] = $userId;
}
 
// Group and order the results
$sql .= " GROUP BY users.user_id, users.name ORDER BY total_spent DESC";
 
// Execute query
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$filteredUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checks</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="../style/navbar.css">

    <style>
    body {
        background-color: #f8f9fa;
    }

    .container {
        margin-top: 2rem;
    }

    .card {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Hover effect for table rows */
    tbody tr {
        transition: transform 0.3s ease;
    }

    tbody tr:hover {
        transform: translateX(5px);
    }

    /* Delete button hover effect */
    .btn-delete {
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-delete:hover {
        background-color: #dc3545;
        transform: scale(1.05);
    }
    </style>
</head>

<body>
    <?php
    displayAdminNavbar($_SESSION["image"]) 
    ?>

    <div class="container mt-5">
        <!-- Filter Form Card -->
        <div class="card mb-4 animate__animated animate__fadeIn">
            <div class="card-body">
                <h2 class="card-title mb-3">Checks</h2>
                <form method="GET" action="">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="date_from" class="form-label">Date From:</label>
                            <input type="date" id="date_from" name="date_from" class="form-control"
                                value="<?= htmlspecialchars($dateFrom) ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="date_to" class="form-label">Date To:</label>
                            <input type="date" id="date_to" name="date_to" class="form-control"
                                value="<?= htmlspecialchars($dateTo) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="user_id" class="form-label">Select User:</label>
                            <select id="user_id" name="user_id" class="form-select" onchange="this.form.submit()">
                                <option value="">All Users</option>
                                <?php foreach ($users as $user): ?>
                                <option value="<?= $user['user_id'] ?>"
                                    <?= ($userId == $user['user_id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($user['name']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Users Table Card -->
        <div class="card animate__animated animate__fadeInUp">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Customer Name</th>
                                <th>Total Spent (LE)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($filteredUsers)): ?>
                            <?php foreach ($filteredUsers as $user): ?>
                            <tr class="animate__animated animate__fadeInUp">
                                <td>
                                    <a class="text-decoration-none text-dark"
                                        href="cus_orders.php?user_id=<?= $user['user_id'] ?>&date_from=<?= $dateFrom ?>&date_to=<?= $dateTo ?>">
                                        <span class="btn btn-outline-dark p-1 rounded-0 me-1">+</span>
                                        <?= htmlspecialchars($user['name']) ?>
                                    </a>
                                </td>
                                <td><?= number_format($user['total_spent'], 2) ?></td>

                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center">No results found.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Bundle JS -->
    <?php include '../includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../javascript/index.js"></script>

</body>

</html>