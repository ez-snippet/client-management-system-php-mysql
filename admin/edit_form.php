<?php
include __DIR__ . "/../config/db.php";
$current_page = basename($_SERVER['PHP_SELF']);
$message = "";

// ===== Get the client id from the URL =====
if (!isset($_GET['id'])) {
    header("Location: view_form.php");
    exit();
}
$id = intval($_GET['id']);

// ===== Handle update submission =====
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $service = $_POST['options'];
    $amount = $_POST['amount'];
    $total = $_POST['total'];
    $remain = $_POST['remain'];
    $adv = $_POST['adv'];
    $dat = $_POST['dat'];

    if (empty($name) || empty($service) || empty($amount) || empty($total) || empty($remain) || empty($adv) || empty($dat)) {
        $message = "please Fill All fileds";
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE clint SET clint_name=?, clint_service=?, Amount=?, Total_Amount=?, Remaing_Amount=?, Adv_Amount=?, months_date=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "sssssssi", $name, $service, $amount, $total, $remain, $adv, $dat, $id);
        mysqli_stmt_execute($stmt);

        header("Location: view_form.php");
        exit();
    }
}

// ===== Fetch existing client data to pre-fill the form =====
$stmt = mysqli_prepare($conn, "SELECT * FROM clint WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($res) === 0) {
    header("Location: view_form.php");
    exit();
}
$client = mysqli_fetch_assoc($res);

// List of services, used to mark the current one as selected
$services = [
    "Website Development" => "Website development",
    "Digital Transformation" => "DIGITAL TRANSFORMATION",
    "Business Consultant" => "BUSINESS CONSULTANT",
    "Digital Business Consultant" => "DIGITAL BUSINESS CONSULTANT",
    "Graphics Designing" => "GRAPHICS DESIGNING",
    "Application Development" => "APPLICATION DEVELOPMENT",
    "AI Chatbot Development" => "AI CHATBOT DEVELOPMENT",
];
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
    <link rel="stylesheet" href="../assets/style/edit_form.css">
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

        <div class="svg_image">
            <img src="../uploads/sales-representative-abstract-concept_335657-3002-removebg-preview.png" alt="Contact SVG">
        </div>

        <div class="form">
            <h2>Edit Client</h2>

            <form method="post">

                <input type="text" name="name" placeholder="Enter your Client" value="<?= htmlspecialchars($client['clint_name']) ?>">
                <br>

                <select name="options" class="selec">
                    <option value="">Select your service</option>
                    <?php foreach ($services as $value => $label): ?>
                        <option value="<?= $value ?>" <?= $client['clint_service'] === $value ? 'selected' : '' ?>>
                            <?= $label ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br>

                <input type="text" name="amount" placeholder="Enter Amount" value="<?= htmlspecialchars($client['Amount']) ?>">
                <br>
                <input type="text" name="total" placeholder="Enter Total Amount" value="<?= htmlspecialchars($client['Total_Amount']) ?>">
                <br>
                <input type="text" name="remain" placeholder="Remaining Amount" value="<?= htmlspecialchars($client['Remaing_Amount']) ?>">
                <br>
                <input type="text" name="adv" placeholder="Enter Advance Amount" value="<?= htmlspecialchars($client['Adv_Amount']) ?>">
                <br>
                <input type="date" name="dat" value="<?= htmlspecialchars($client['months_date']) ?>">

                <p style="text-align: center; margin-top: 10px; color: red;"><?= $message ?></p>

                <button type="submit" name="submit" id="btn">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Update Client
                </button>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>