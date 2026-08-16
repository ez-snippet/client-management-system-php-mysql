<?php
include __DIR__ . "/../config/db.php";
$current_page = basename($_SERVER['PHP_SELF']);

/* ============ Revenue Calculations ============ */

// 1) Total Revenue (sab clients ka Total_Amount jama)
$totalRevenue = 0;
$res = mysqli_query($conn, "SELECT SUM(Total_Amount) AS total FROM clint");
if ($res && $row = mysqli_fetch_assoc($res)) {
    $totalRevenue = $row['total'] ? $row['total'] : 0;
}

// 2) Is Mahine ka Revenue (current month)
$thisMonthRevenue = 0;
$res = mysqli_query($conn, "SELECT SUM(Total_Amount) AS total FROM clint 
    WHERE MONTH(months_date) = MONTH(CURDATE()) AND YEAR(months_date) = YEAR(CURDATE())");
if ($res && $row = mysqli_fetch_assoc($res)) {
    $thisMonthRevenue = $row['total'] ? $row['total'] : 0;
}

// 3) September ka Revenue (is saal ka September)
$septRevenue = 0;
$res = mysqli_query($conn, "SELECT SUM(Total_Amount) AS total FROM clint 
    WHERE MONTH(months_date) = 9 AND YEAR(months_date) = YEAR(CURDATE())");
if ($res && $row = mysqli_fetch_assoc($res)) {
    $septRevenue = $row['total'] ? $row['total'] : 0;
}

// 4) Market mein kitna paisa phasa hai (Remaining Amount ka total)
$totalPending = 0;
$res = mysqli_query($conn, "SELECT SUM(Remaing_Amount) AS total FROM clint");
if ($res && $row = mysqli_fetch_assoc($res)) {
    $totalPending = $row['total'] ? $row['total'] : 0;
}

// 5) Kitna paisa wapas aa gaya (Received = Total - Remaining)
$totalReceived = $totalRevenue - $totalPending;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/dashboard.css">
    <link rel="icon" href="../uploads/logo.jfif">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-black text-white">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">
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
                    <a class="nav-link <?= $current_page == 'view.php' ? 'active' : '' ?>" href="view_form.php">
                        <i class="fa-solid fa-box me-2"></i>View Clniet
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="../admin/logout.php">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            <h4 class="mb-4">Revenue Overview</h4>

            <div class="row g-3">

                <div class="col-md-4 col-sm-6">
                    <div class="stat-card d-flex align-items-center gap-3">
                        <div class="icon bg-revenue">
                            <i class="fa-solid fa-sack-dollar"></i>
                        </div>
                        <div>
                            <div class="label">Total Revenue</div>
                            <div class="value">Rs <?= number_format($totalRevenue) ?></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="stat-card d-flex align-items-center gap-3">
                        <div class="icon bg-products">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                        <div>
                            <div class="label">This Month Revenue</div>
                            <div class="value">Rs <?= number_format($thisMonthRevenue) ?></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="stat-card d-flex align-items-center gap-3">
                        <div class="icon bg-orders">
                            <i class="fa-solid fa-leaf"></i>
                        </div>
                        <div>
                            <div class="label">September Revenue</div>
                            <div class="value">Rs <?= number_format($septRevenue) ?></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6">
                    <div class="stat-card d-flex align-items-center gap-3">
                        <div class="icon bg-pending">
                            <i class="fa-solid fa-hourglass-half"></i>
                        </div>
                        <div>
                            <div class="label">Pending in Market</div>
                            <div class="value">Rs <?= number_format($totalPending) ?></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6">
                    <div class="stat-card d-flex align-items-center gap-3">
                        <div class="icon bg-received">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div>
                        <div>
                            <div class="label">Total Received</div>
                            <div class="value">Rs <?= number_format($totalReceived) ?></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>