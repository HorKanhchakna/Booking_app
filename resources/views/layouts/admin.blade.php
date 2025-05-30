<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Dashboard - @yield('title', 'Default Title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(to right, #f0f4f8, #e8eff5);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            height: 100vh;
            background-color: #1c2541;
            color: white;
            padding-top: 20px;
            position: fixed;
            top: 0;
            left: 0;
            width: 240px;
        }
        .sidebar h4 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            font-weight: 500;
            transition: 0.2s;
            cursor: pointer;
        }
        .sidebar a:hover {
            background-color: #3a506b;
            border-left: 5px solid #ffffff;
            padding-left: 25px;
        }
        .content-area {
            margin-left: 240px;
            padding: 40px 30px;
        }
        .dashboard-container {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .table thead {
            background-color: #1c6dd0;
            color: white;
        }
        .btn-approve {
            background-color: #38b000;
            color: white;
            border: none;
        }
        .btn-approve:hover {
            background-color: #2d8600;
        }
        h2 {
            color: #1c2541;
            font-weight: bold;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }
            .content-area {
                margin-left: 0;
                padding: 20px;
            }
        }
        .section {
            display: none;
        }
        .section.active {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <h4><i class="bi bi-speedometer2"></i> Admin Panel</h4>
        <a data-section="dashboard"><i class="bi bi-house-door-fill me-2"></i> Dashboard</a>
        <a data-section="booking"><i class="bi bi-book-fill me-2"></i> Booking</a>
        <a data-section="destination"><i class="bi bi-geo-alt-fill me-2"></i> Destination</a>
        <a data-section="target"><i class="bi bi-bullseye me-2"></i> Target</a>
    </nav>

    <!-- Content Area -->
    <div class="content-area">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Button Approve Interaction & Sidebar Navigation -->
    <script>
        document.querySelectorAll(".btn-approve").forEach((button) => {
            button.addEventListener("click", function (e) {
                e.preventDefault(); // Prevent form submission for alert demo
                alert("Booking has been approved!");
                this.closest('form').submit(); // Submit the form after alert
            });
        });

        document.querySelectorAll(".sidebar a").forEach((link) => {
            link.addEventListener("click", function () {
                const sectionId = this.getAttribute("data-section");
                document.querySelectorAll(".section").forEach((sec) => {
                    sec.classList.remove("active");
                });
                document.getElementById(sectionId).classList.add("active");
            });
        });
    </script>
</body>
</html>