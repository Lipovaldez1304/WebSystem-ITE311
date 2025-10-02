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
            color: #2c3e50;
        }
        
        .content-text {
            color: #bd7070ff;
            line-height: 1.6;
        }
    </style>
</head>
<body>
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
    <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow p-4" style="width: 400px;">
        <h3 class="text-center mb-4">Login</h3>
    <?php if (session()->getFlashdata('error')): ?>
          <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
          </div>
    <?php endif; ?>

    <form action="<?= base_url('login/auth') ?>" method="post">
        <?= csrf_field() ?>
      <div class="mb-3">
         <label for="email">Email:</label>
        <input type="email" name="email" class="form-control" id="email" required>
      </div>
      <div class="mb-3">
         <label for="password">Password:</label>
        <input type="password" name="password" class="form-control" id="password" required>
      </div>
      <button  type="submit" class="btn btn-primary w-100">Login</button>
    </form>
     </div>
</div>
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    </body>
</html>
