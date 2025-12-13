<?= $this->include('templates/header') ?>

<div class="main-content" id="mainContent">
    <div class="container mt-5 mb-5">

        <div class="dash-card">

            <!-- PAGE HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="dash-title mb-0">
                    <i class="bi bi-person-plus"></i> Add New User
                </h2>

                <a href="<?= site_url('admin/manage-users') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Back to Manage Users
                </a>
            </div>

            <hr class="my-4">

            <!-- ERROR MESSAGES -->
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- ADD USER FORM -->
            <form action="<?= site_url('admin/add-user') ?>" method="post">
                <?= csrf_field() ?>

                <div class="row">
                    <!-- Full Name -->
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label fw-semibold">
                            <i class="bi bi-person-fill text-success"></i> Full Name
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            class="form-control"
                            value="<?= old('name') ?>" 
                            placeholder="Enter full name"
                            required>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label fw-semibold">
                            <i class="bi bi-envelope-fill text-success"></i> Email
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            class="form-control"
                            value="<?= old('email') ?>"
                            placeholder="user@example.com"
                            required>
                    </div>
                </div>

                <!-- Role -->
                <div class="mb-3">
                    <label for="role" class="form-label fw-semibold">
                        <i class="bi bi-shield-fill text-success"></i> Role
                    </label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="">-- Select Role --</option>
                        <option value="admin"   <?= old('role')=='admin'?'selected':'' ?>>Admin</option>
                        <option value="teacher" <?= old('role')=='teacher'?'selected':'' ?>>Teacher</option>
                        <option value="student" <?= old('role')=='student'?'selected':'' ?>>Student</option>
                    </select>
                </div>



                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">
                        <i class="bi bi-key-fill text-success"></i> Password 
                        <small class="text-muted">(Optional)</small>
                    </label>
                    <input 
                        type="text" 
                        name="password" 
                        id="password" 
                        class="form-control"
                        placeholder="Leave blank to use default: Rmmc1960">
                </div>

                
                

                <!-- Action Buttons -->
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Add User
                    </button>
                    <a href="<?= site_url('admin/manage-users') ?>" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Auto-hide flash alerts -->
<script>
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            bootstrap.Alert.getOrCreateInstance(alert).close();
        });
    }, 4000);
</script>

<?= $this->include('templates/footer') ?>