<?= $this->include('templates/header') ?>

<div class="main-content" id="mainContent">
    <div class="container mt-5 mb-5">

        <div class="dash-card">


            <!-- DASHBOARD HEADER -->
            <h2 class="dash-title">
                <i class="bi bi-speedometer2"></i> Welcome, <?= esc($name) ?>!
            </h2>   
            <p class="text-muted fs-5">
                Role: <strong><?= esc(ucfirst($role)) ?></strong>
            </p>
            <hr class="my-4">

            <!-- ===========================================
                 ROLE-BASED DASHBOARD
            ============================================ -->

            <?php if ($role === 'admin'): ?>
                <div class="role-banner">
                    <h4><i class="bi bi-shield-lock text-primary"></i> Admin Control Panel</h4>
                    <p><strong>Total Users:</strong> <?= esc($total_users ?? 0) ?></p>
                    <p><strong>Restricted Users:</strong> <?= esc($restricted_users ?? 0) ?></p>
                    <p><strong>Active Users:</strong> <?= esc($active_users ?? 0) ?></p>
                </div>

                <div class="section-header">
                     Quick Actions
                </div>

                <a href="<?= site_url('admin/manage-users') ?>" class="btn btn-primary quick-btn me-2 mb-2">
                    <i class="bi bi-people"></i> Manage Users
                </a>
                <button class="btn btn-success quick-btn me-2 mb-2">
                    <i class="bi bi-journal-text"></i> Create Course
                </button>
                <button class="btn btn-info quick-btn mb-2">
                    <i class="bi bi-bar-chart-line"></i> Reports
                </button>

            <?php elseif ($role === 'teacher'): ?>
                <div class="role-banner" style="border-color:#ffc107;">
                    <h4><i class="bi bi-journal-text text-warning"></i> Teacher Portal</h4>
                    <p><strong>Pending Grading:</strong> <?= esc($pending_grading ?? 0) ?></p>

                    <p class="mt-2"><strong>Assigned Courses:</strong></p>
                    <ul class="ms-2">
                        <?php if (!empty($courses)): ?>
                            <?php foreach ($courses as $course): ?>
                                <li><?= esc($course) ?></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>No courses assigned.</li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="section-header">
                    <i class="bi bi-lightning-fill text-warning"></i> Quick Actions
                </div>

                <button class="btn btn-primary quick-btn me-2 mb-2">
                    <i class="bi bi-file-earmark-plus"></i> Create Assignment
                </button>
                <button class="btn btn-success quick-btn me-2 mb-2">
                    <i class="bi bi-clipboard-check"></i> Grade Students
                </button>
                <button class="btn btn-info quick-btn mb-2">
                    <i class="bi bi-calendar-event"></i> Schedule
                </button>

            <?php elseif ($role === 'student'): ?>
                <div class="role-banner" style="border-color:#0dcaf0;">
                    <h4><i class="bi bi-mortarboard-fill text-info"></i> Student Dashboard</h4>
                    <p><strong>Upcoming Submission:</strong> <?= esc($due_date ?? 'None') ?></p>

                    <p class="mt-2"><strong>Your Grades:</strong></p>
                    <ul class="ms-2">
                        <?php if (!empty($grades)): ?>
                            <?php foreach ($grades as $grade): ?>
                                <li><?= esc($grade) ?></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>No grades available.</li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="section-header">
                    <i class="bi bi-lightning-fill text-info"></i> Quick Actions
                </div>

                <button class="btn btn-primary quick-btn me-2 mb-2">
                    <i class="bi bi-upload"></i> Submit Work
                </button>
                <button class="btn btn-success quick-btn me-2 mb-2">
                    <i class="bi bi-trophy-fill"></i> View Grades
                </button>
                <button class="btn btn-info quick-btn mb-2">
                    <i class="bi bi-book-half"></i> Browse Courses
                </button>

            <?php endif; ?>

        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>