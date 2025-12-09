<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Register' ?></title>

    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">

    <style>
        body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
        .top-header { background-color: #3a8bdbff; color: white; padding: 1rem 0; }
        .site-title { font-size: 1.5rem; font-weight: 500; margin: 0; }
        .nav-links { display: flex; gap: 2rem; margin: 0; list-style: none; padding: 0; }
        .nav-links a { color: white; text-decoration: none; font-size: 1rem; }
    </style>
</head>
<body>

<header class="top-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="site-title">RMMC LMS</h1>
            <nav>
                <ul class="nav-links">
                    <li><a href="<?= base_url('register') ?>">Register</a></li>
                    <li><a href="<?= base_url('login') ?>">Login</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<!-- SUCCESS MESSAGE -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
<?php endif; ?>

<!-- GENERAL ERROR MESSAGE -->
<?php if (session()->getFlashdata('error')): ?>
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
<?php endif; ?>

<!-- VALIDATION SUMMARY -->
<?php $validationErrors = session()->getFlashdata('errors'); ?>
<?php if ($validationErrors): ?>
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show">
            <h4 class="alert-heading">Please fix the errors below:</h4>
            <ul class="mb-0">
                <?php foreach ($validationErrors as $err): ?>
                    <li><?= esc($err) ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
<?php endif; ?>

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow p-4" style="width: 450px;">

        <h3 class="text-center mb-4">Create an Account</h3>

        
        <!-- FORM -->
        <form action="<?= site_url('register') ?>" method="post">
                    <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label    ">Username:</label>
                <input 
                    type="text" 
                    name="name" 
                    class="form-control"
                    value="<?= old('name') ?>"
                    required
                >
                <?php if (isset($validationErrors['name'])): ?>
                    <p class="text-danger small"><?= esc($validationErrors['name']) ?></p>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input 
                    type="email" 
                    name="email" 
                    class="form-control"
                    value="<?= old('email') ?>"
                    required
                >
                <?php if (isset($validationErrors['email'])): ?>
                    <p class="text-danger small"><?= esc($validationErrors['email']) ?></p>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Password:</label>
                <input 
                    type="password" 
                    name="password" 
                    class="form-control"
                    required
                >
                <?php if (isset($validationErrors['password'])): ?>
                    <p class="text-danger small"><?= esc($validationErrors['password']) ?></p>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password:</label>
                <input 
                    type="password" 
                    name="confirm_password" 
                    class="form-control"
                    required
                >
                <?php if (isset($validationErrors['pass_confirm'])): ?>
                    <p class="text-danger small"><?= esc($validationErrors['pass_confirm']) ?></p>
                <?php endif; ?>
            </div>

            <button class="btn btn-primary w-100" type="submit">Register</button>
        </form>

        <div class="text-center mt-3">
            <p>Already have an account? <a href="<?= base_url('login') ?>">Login here</a></p>
        </div>

    </div>
</div>

<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
