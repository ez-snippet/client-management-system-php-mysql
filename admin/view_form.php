<?php
include __DIR__ . "/../config/db.php";
$current_page = basename($_SERVER['PHP_SELF']);

// ===== Backend: fetch all clients =====
$sql = "SELECT * FROM clint ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="icon" href="../uploads/logo.jfif">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/style/view_form.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-black">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../uploads/logo.jfif" alt="Logo" class="logo" style="width: 50px; height: 50px; border-radius: 50%;">
            </a>
            <button
                class="navbar-toggler d-lg-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId"
                aria-controls="collapsibleNavId"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link mt-1 text-white" href="#"> Admin Profile<img src="../uploads/146440514.jfif" class="ms-3" style="width: 35px; height: 35px; border-radius: 50%;" alt=""></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="d-flex">

        <!-- Sidebar -->
        <div class="sidebar p-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'dashboard.php' ? 'active' : '' ?>" href="dashboard.php">
                        <i class="fa-solid fa-house me-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'add_form.php' ? 'active' : '' ?>" href="add_form.php">
                        <i class="fa-solid fa-shoe-prints me-2"></i> Add Client
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'view_form.php' ? 'active' : '' ?>" href="view_form.php">
                        <i class="fa-solid fa-box me-2"></i>View Client
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="../admin/logout.php">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main content -->
        <div class="main-content">

            <div class="table-card">
                <div class="table-card-header">
                    <h2><i class="fa-solid fa-users me-2"></i>Clients</h2>
                    <a href="add_form.php" class="btn-add">
                        <i class="fa-solid fa-plus me-1"></i> Add Client
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Client Name</th>
                                <th>Service</th>
                                <th>Amount</th>
                                <th>Total Amount</th>
                                <th>Remaining</th>
                                <th>Advance</th>
                                <th>Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php $i = 1; ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= htmlspecialchars($row['clint_name']) ?></td>
                                        <td><span class="badge-service"><?= htmlspecialchars($row['clint_service']) ?></span></td>
                                        <td><?= htmlspecialchars($row['Amount']) ?></td>
                                        <td><?= htmlspecialchars($row['Total_Amount']) ?></td>
                                        <td>
                                            <span class="badge-remain <?= $row['Remaing_Amount'] == 0 ? 'paid' : 'pending' ?>">
                                                <?= htmlspecialchars($row['Remaing_Amount']) ?>
                                            </span>
                                        </td>
                                        <td><?= htmlspecialchars($row['Adv_Amount']) ?></td>
                                        <td><?= htmlspecialchars($row['months_date']) ?></td>
                                        <td class="text-center">
                                            <a href="edit_form.php?id=<?= $row['id'] ?>" class="icon-btn edit" title="Edit">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            <a href="delete_form.php?id=<?= $row['id'] ?>" class="icon-btn delete" title="Delete" onclick="return confirm('Delete this client?');">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center empty-row">No clients found yet.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>