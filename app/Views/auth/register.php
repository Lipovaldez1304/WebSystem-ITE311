<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'CI4 Site' ?></title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        .top-header {
            background-color: #3a8bdbff;
            color: white;
            padding: 1rem 0;
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
        }
        
        .nav-links a:hover {
            color: #bdc3c7;
        }
        
        .main-content {
            padding: 3rem 0;
            min-height: 70vh;
        }
        
        .page-title {
            font-size: 2.5rem;
            font-weight: 300;
            margin-bottom: 1.5rem;
            color: #4280bdff;
        }
        
        .content-text {
            color: #666;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <!-- Top Header -->
    <header class="top-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="site-title">CI4 Site</h1>
                <nav>
                    <ul class="nav-links">
                        <li><a href="<?= base_url('register') ?>">Register</a></li>
                        <li><a href="<?= base_url('login') ?>">Login</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Flash Messages -->
    <?php $errors = session('errors') ?? []; ?>
    
    <?php if (session('success')): ?>
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= esc(session('success')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>

    <!-- Registration Form -->
    <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow p-4" style="width: 450px;">
            <h3 class="text-center mb-4">Register</h3>
            
            <?= form_open('/register') ?>
                <div class="mb-3">
                    <label for="name" class="form-label">Username:</label>
                    <input 
                        name="name" 
                        type="text" 
                        value="<?= old('name') ?>" 
                        required 
                        class="form-control" 
                        id="name"
                        placeholder="Enter your username"
                    >
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input 
                        name="email" 
                        type="email" 
                        value="<?= old('email') ?>" 
                        required 
                        class="form-control" 
                        id="email"
                        placeholder="Enter your email"
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input 
                        name="password" 
                        type="password" 
                        required 
                        class="form-control" 
                        id="password"
                        placeholder="Enter your password"
                    >
                </div>

                <div class="mb-3">
                    <label for="password_confirm" class="form-label">Confirm Password:</label>
                    <input 
                        name="pass_confirm" 
                        type="password" 
                        required 
                        class="form-control" 
                        id="password_confirm"
                        placeholder="Confirm your password"
                    >
                </div>

                <button type="submit" class="btn btn-primary w-100">Register</button>
            <?= form_close() ?>

            <div class="text-center mt-3">
                <p class="mb-0">Already have an account? <a href="<?= base_url('login') ?>">Login here</a></p>
            </div>
        </div>
    </div>

    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>