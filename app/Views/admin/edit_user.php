<?= $this->include('templates/header') ?>

<div class="main-content" id="mainContent">
    <div class="container mt-5 mb-5">

        <div class="dash-card">

            <!-- PAGE HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="dash-title mb-0">
                    <i class="bi bi-person-lines-fill"></i> Edit User
                </h2>

                <a href="<?= site_url('admin/manage-users') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Back to Manage Users
                </a>
            </div>

            <hr class="my-4">

            <!-- FLASH MESSAGES -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php elseif (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- EDIT FORM -->
            <form action="<?= site_url('admin/update-user/' . $user['id']) ?>" method="post">
                <?= csrf_field() ?>

                <div class="row">
                    <!-- Full Name -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-person-fill text-primary"></i> Full Name
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            class="form-control" 
                            value="<?= esc($user['name']) ?>" 
                            required>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-envelope-fill text-primary"></i> Email
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            class="form-control" 
                            value="<?= esc($user['email']) ?>" 
                            required>
                    </div>
                </div>

                <!-- Role -->
                <?php if ($user['role'] !== 'admin'): ?>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-shield-fill text-primary"></i> Role
                        </label>
                        <select name="role" class="form-control" required>
                            <option value="teacher" <?= $user['role'] === 'teacher' ? 'selected' : '' ?>>Teacher</option>
                            <option value="student" <?= $user['role'] === 'student' ? 'selected' : '' ?>>Student</option>
                        </select>
                    </div>
                <?php else: ?>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-shield-lock-fill text-primary"></i> Role
                        </label>
                        <input type="text" class="form-control" value="Admin (Cannot be changed)" disabled>
                    </div>
                <?php endif; ?>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-key-fill text-primary"></i> New Password 
                        <small class="text-muted">(Optional)</small>
                    </label>

                    <div class="input-group">
                        <input 
                            type="password" 
                            name="password" 
                            id="password"
                            class="form-control"
                            placeholder="Leave blank to keep current password">

                        <button type="button" class="btn btn-outline-primary" id="setDefaultBtn">
                            <i class="bi bi-key"></i> Set Default
                        </button>
                    </div>

                    <small class="text-muted">
                        Default password: <strong>Rmmc1960</strong>
                    </small>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Save Changes
                    </button>

                    <a href="<?= site_url('admin/manage-users') ?>" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    // Set default password
    document.getElementById('setDefaultBtn').addEventListener('click', () => {
        document.getElementById('password').value = "Rmmc1960";
    });

    // Auto-hide flash alerts (4 seconds)
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            bootstrap.Alert.getOrCreateInstance(alert).close();
        });
    }, 4000);
</script>

<?= $this->include('templates/footer') ?>

