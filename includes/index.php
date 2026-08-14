<?php
include __DIR__ . "/../config/db.php";
$message = "";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    if (empty($name) || empty($pass)) {
        $message = "please Enter your username and password";
    } elseif ($name == "admin" && $pass == "admin123") {
        header("Location:../admin/dashboard.php");
        exit;
    } else {
        $message = "invalid username and password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Mindset Hub software </title>
    <link rel="shortcut icon" href="../uploads/logo.jfif" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/main.css">
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
                aria-label="Toggle navigation text-while ">
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
    <div class="main">
        <div class="svg_image">
            <img src="../uploads/premium-download-illustration-of-billing-management-vector-removebg-preview.png" alt="Contact SVG">
        </div>
        <div class="form">
            <h2>Welcome Back 👋</h2>
            <form method="post" id="form">
                <input type="text" name="name" id="name" placeholder=" 👤 Enter your username">
                <br>
                <span id="e1"></span>
                <input type="password" name="pass" id="email" placeholder=" 🔒 Enter your password">
                <br>
                <p style="text-align: center; margin-top: 10px; color: red;"><?php echo $message ?></p>
                <span id="e2"></span>
                <button type="submit" name="submit" id="btn">
                    <i class="fa-solid fa-arrow-right-to-bracket text-white"></i> Login
                </button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>