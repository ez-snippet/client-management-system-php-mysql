<?php
include __DIR__ . "/../config/db.php";
$current_page = basename($_SERVER['PHP_SELF']);
$message = "";
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $service = $_POST['options'];
    $total = $_POST['total'];
    $adv = $_POST['adv'];
    $dat = $_POST['dat'];

    // Remaining ab manual nahi, hamesha Total - Advance se server pe calculate hota hai (trust nahi karte client value pe)
    $remain = (is_numeric($total) && is_numeric($adv)) ? ($total - $adv) : 0;

    // Amount (received) = Total - Remaining = Advance ke barabar hi ban jata hai
    $amount = (is_numeric($total) && is_numeric($remain)) ? ($total - $remain) : 0;

    if (empty($name) || empty($service) || empty($total) || empty($adv) || empty($dat)) {
        $message = "please Fill All fileds";
    }
    else{
    $stmt = mysqli_prepare($conn, "INSERT INTO clint(clint_name, clint_service, Amount, Total_Amount, Remaing_Amount, Adv_Amount, months_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssdddds", $name, $service, $amount, $total, $remain, $adv, $dat);
    $result = mysqli_stmt_execute($stmt);
    if (!$result) {
        $message = "please Enter correct fileds";
    } else {
        header("Location:view_form.php");
        exit();
    }
    }
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
    <link rel="stylesheet" href="../assets/style/add_form.css">
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
                    <a class="nav-link <?= $current_page == 'view.php' ? 'active' : '' ?>" href="view_form.php">
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
            <h2>Add Client</h2>

            <form method="post" id="form" enctype="multipart/form-data">

                <input type="text" name="name" id="name" placeholder="Enter your Client">
                <br>
                <span id="e1"></span>
                <select name="options" class="selec">
                    <option value="">Select your service</option>
                    <option value="Website Development">Website development</option>
                    <option value="Digital Transformation">DIGITAL TRANSFORMATION</option>
                    <option value="Business Consultant">BUSINESS CONSULTANT</option>
                    <option value="Digital Business Consultant">DIGITAL BUSINESS CONSULTANT</option>
                    <option value="Graphics Designing">GRAPHICS DESIGNING</option>
                    <option value="Application Development">APPLICATION DEVELOPMENT</option>
                    <option value="AI Chatbot Development">AI CHATBOT DEVELOPMENT</option>
                </select>
                <br>
                <input type="text" name="total" id="total" placeholder="Enter Total Amount">
                <br>
                <input type="text" name="adv" id="adv" placeholder="Enter Advance Amount">
                <br>

                <!-- Remaining ab auto-calculate hota hai: Total - Advance -->
                <input type="text" name="remain" id="remain" placeholder="Remaining Amount (auto)" readonly>
                <br>

                <input type="date" name="dat" placeholder="Select Date">
                <p style="text-align: center; margin-top: 10px; color: red;"><?php echo $message ?></p>
                <button type="submit" name="submit" id="btn">
                    + Add Client
                </button>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const totalInput = document.getElementById('total');
        const advInput = document.getElementById('adv');
        const remainInput = document.getElementById('remain');

        function calculateRemaining() {
            const total = parseFloat(totalInput.value) || 0;
            const adv = parseFloat(advInput.value) || 0;
            const remain = total - adv;
            remainInput.value = isNaN(remain) ? '' : remain;
        }

        totalInput.addEventListener('input', calculateRemaining);
        advInput.addEventListener('input', calculateRemaining);
    </script>
</body>

</html>