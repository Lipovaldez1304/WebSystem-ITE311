<?= $this->include('templates/header') ?>

<div class="main-content" id="mainContent">
    <div class="container mt-5 mb-5">

        <div class="dash-card">

            <!-- PAGE HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <h2 class="dash-title mb-0">
                    <i class="bi bi-people"></i> Manage Users
                </h2>

                <a href="<?= site_url('admin/add-user') ?>" class="btn btn-success">
                    <i class="bi bi-person-plus"></i> Add New User
                </a>
            </div>

            <hr class="my-4">

            <!-- STATISTICS -->
            <div class="d-flex gap-3 flex-wrap mb-4">
                <?php if (!empty($users)): ?>
                    <span class="badge bg-primary fs-6">
                        Total: <?= count($users) ?>
                    </span>
                    <span class="badge bg-success fs-6">
                        Active: <?= count(array_filter($users, fn($u) => $u['is_restricted'] == 0)) ?>
                    </span>
                    <span class="badge bg-danger fs-6">
                        Restricted: <?= $restricted_count ?? 0 ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- FLASH MESSAGES -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?= session()->getFlashdata('success') ?>
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php elseif (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= session()->getFlashdata('error') ?>
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- USERS TABLE -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th width="280">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (empty($users)): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                    No users found
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($users as $u): ?>
                                <tr>
                                    <td><strong><?= esc($u['id']) ?></strong></td>
                                    <td><?= esc($u['name']) ?></td>
                                    <td><?= esc($u['email']) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $u['role'] === 'admin' ? 'primary' : ($u['role'] === 'teacher' ? 'warning' : 'info') ?>">
                                            <?= ucfirst(esc($u['role'])) ?>
                                        </span>
                                    </td>

                                    <td>
                                        <?php if ($u['is_restricted'] == 1): ?>
                                            <span class="badge bg-danger">
                                                <i class="bi bi-lock-fill"></i> Restricted
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle-fill"></i> Active
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <!-- Edit Button (allowed for ALL users) -->
                                        <a href="<?= site_url('admin/edit-user/' . $u['id']) ?>" 
                                           class="btn btn-warning btn-sm" title="Edit User">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>

                                        <!-- Restrict/Unrestrict Buttons (NOT allowed for admin) -->
                                        <?php if ($u['role'] !== 'admin'): ?> 
                                            <?php if ($u['is_restricted'] == 1): ?>
                                                <a href="<?= site_url('admin/unrestrict-user/' . $u['id']) ?>"
                                                   class="btn btn-success btn-sm"
                                                   onclick="return confirm('Unrestrict this user?');"
                                                   title="Unrestrict User">
                                                   <i class="bi bi-unlock-fill"></i> Unrestrict
                                                </a>
                                            <?php else: ?>
                                                <a href="<?= site_url('admin/restrict-user/' . $u['id']) ?>"
                                                   class="btn btn-danger btn-sm"
                                                   onclick="return confirm('Restrict this user?');"
                                                   title="Restrict User">
                                                   <i class="bi bi-lock-fill"></i> Restrict
                                                </a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="text-muted small">
                                                <i class="bi bi-shield-lock"></i> Protected
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- Auto-hide flash alerts after 4 seconds -->
<script>
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            bootstrap.Alert.getOrCreateInstance(alert).close();
        });
    }, 4000);
</script>

<?= $this->include('templates/footer') ?>