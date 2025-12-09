<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Dashboard') ?></title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6fa;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* REMOVE SHADOW/OUTLINE ON CLICK */
        .btn:focus, 
        .btn:active,
        .form-control:focus,
        .form-select:focus,
        input:focus,
        textarea:focus {
            box-shadow: none !important;
            outline: none !important;
        }

        /* SIDEBAR ------------------------------------------------*/
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: #1443a7ff;
            padding-top: 20px;
            transition: 0.3s;
            z-index: 2000;
        }

        .sidebar.collapsed {
            width: 75px;
        }

        .sidebar .logo {
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
            transition: 0.3s;
        }

        .sidebar.collapsed .logo-text {
            display: none;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px 18px;
            color: #d1d5db;
            font-weight: 500;
            text-decoration: none;
            transition: 0.25s;
            border-radius: 10px;
            margin: 6px 12px;
            font-size: 15px;
        }

        .sidebar a:hover {
            background: #1858b1ff;
            color: #fff;
            transform: translateX(6px);
        }

        .sidebar i {
            font-size: 20px;
            margin-right: 14px;
        }

        .sidebar.collapsed i {
            margin-right: 0;
        }

        .sidebar.collapsed span {
            display: none;
        }

        /* TOP NAV ------------------------------------------------*/
        .topbar {
            width: 100%;
            height: 60px;
            background: #fff;
            display: flex;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.06);
            position: fixed;
            top: 0;
            z-index: 1000;
            margin-left: 250px;
            transition: 0.3s;
        }

        .topbar.collapsed {
            margin-left: 75px;
        }

        /* TOGGLE BUTTON WITH BOX ARROW */
        .toggle-box {
            width: 40px;
            height: 40px;
            background: #1443a7ff;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 15px;
        }

        .toggle-box:hover {
            background: #1858b1ff;
            transform: scale(1.05);
        }

        .toggle-box i {
            color: #fff;
            font-size: 20px;
            transition: transform 0.3s ease;
        }

        /* Rotate arrow when collapsed */
        .toggle-box.collapsed i {
            transform: rotate(180deg);
        }

        /* MAIN CONTENT ------------------------------------------*/
        .main-content {
            margin-left: 250px;
            padding-top: 80px;
            transition: 0.3s;
        }

        .main-content.collapsed {
            margin-left: 75px;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">

        <div class="logo">
            <span class="logo-text">RMMC LMS</span>
        </div>

        <a href="<?= base_url('dashboard') ?>">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>

        <?php $role = session()->get('role'); ?>

        <?php if ($role === 'admin'): ?>
            <a href="<?= base_url('admin/manage-users') ?>">
                <i class="bi bi-people-fill"></i>
                <span>Manage Users</span>
            </a>

            <a href="#">
                <i class="bi bi-journal-plus"></i>
                <span>Courses</span>
            </a>

            <a href="#">
                <i class="bi bi-bar-chart-fill"></i>
                <span>Reports</span>
            </a>
        <?php endif; ?>

        <?php if ($role === 'teacher'): ?>
            <a href="#">
                <i class="bi bi-journal-plus"></i>
                <span>Create Assignments</span>
            </a>

            <a href="#">
                <i class="bi bi-clipboard-check"></i>
                <span>Grade Students</span>
            </a>
        <?php endif; ?>

        <?php if ($role === 'student'): ?>
            <a href="#">
                <i class="bi bi-trophy"></i>
                <span>My Grades</span>
            </a>

            <a href="#">
                <i class="bi bi-book"></i>
                <span>My Courses</span>
            </a>
        <?php endif; ?>

        <a href="<?= base_url('logout') ?>">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </a>

    </div>

    <!-- TOP NAV BAR -->
    <div class="topbar" id="topbar">
        <div class="toggle-box" id="toggleBtn">
            <i class="bi bi-chevron-left"></i>
        </div>
        
    </div>