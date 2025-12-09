<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title><?= isset($title) ? $title : 'Login' ?></title>

     <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">

     <style>
         body {
             margin: 0;
             font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
             background-color: #f5f5f5;
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
             opacity: 0.8;
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
                    <li><a href="<?= base_url('register') ?>">Register</a></li>
                    <li><a href="<?= base_url('login') ?>">Login</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow p-4" style="width: 400px;">

        <h3 class="text-center mb-4">Login</h3>

        <!-- ERROR MESSAGE -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- SUCCESS MESSAGE -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('login') ?>" method="post">
   <?= csrf_field() ?>

    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input 
            type="email" 
            name="email" 
            id="email" 
            class="form-control" 
            value="<?= old('email') ?>"
            required
        >
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input 
            type="password" 
            name="password" 
            id="password" 
            class="form-control" 
            required
        >
    </div>

    <button type="submit" class="btn btn-primary w-100">Login</button>
</form>


    </div>
</div>
<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
<script>
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            try {
                let bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                bsAlert.close();
            } catch (e) {}
        });
    }, 5000);
</script>

</body>
</html>
