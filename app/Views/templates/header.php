<?php $session = session(); $role = $session->get('role'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'LMS Dashboard' ?></title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        /* Using a simplified navbar design based on your styles */
        .top-header {
            background-color: #3a8bdbff;
            color: white;
            padding: 0.5rem 0; /* Adjusted padding */
        }
        
        .site-title {
            font-size: 1.5rem;
            font-weight: 500;
            margin: 0;
        }
        
        .nav-links {
            display: flex;
            gap: 2rem;
            margin: 0;
            list-style: none;
            padding: 0;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 1rem;
            padding: 0.5rem 0;
        }
        
        .nav-links a:hover {
            color: #bdc3c7;
        }
        
        .page-title {
            font-size: 2.5rem;
            font-weight: 300;
            margin-bottom: 1.5rem;
            color: #508bc5ff;
        }
        
        .content-text {
            color: #666;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <header class="top-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="site-title">RMMC LMS</h1>
                <nav>
                    <ul class="nav-links">
                        <li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        
                        <?php if ($role === 'admin'): ?>
                            <li><a href="<?= base_url('admin/users') ?>">Manage Users</a></li>
                            <li><a href="<?= base_url('admin/config') ?>">Settings</a></li>
                        <?php elseif ($role === 'teacher'): ?>
                            <li><a href="<?= base_url('teacher/courses') ?>">My Courses</a></li>
                            <li><a href="<?= base_url('teacher/grading') ?>">Gradebook</a></li>
                        <?php elseif ($role === 'student'): ?>
                            <li><a href="<?= base_url('student/grades') ?>">My Grades</a></li>
                            <li><a href="<?= base_url('student/enroll') ?>">Enrollment</a></li>
                        <?php endif; ?>

                        <li><a href="<?= base_url('logout') ?>">Logout (<?= ucfirst($role) ?>)</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="container mt-5"></div>