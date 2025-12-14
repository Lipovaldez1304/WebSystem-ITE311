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
            

            <!-- ==========================
                 ROLE-BASED DASHBOARD
            ===============================-->

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
                    <p><strong>Total Enrolled Courses:</strong> <?= esc($total_enrolled ?? 0) ?></p>
                    <p><strong>Upcoming Submission:</strong> <?= esc($due_date ?? 'None') ?></p>
                </div>

                <!-- ==========================
                     ENROLLED COURSES SECTION
                ===============================-->
                <div class="section-header mt-4">
                    <i class="bi bi-book-fill text-success"></i> My Enrolled Courses
                </div>

                <div id="enrolledCoursesContainer">
                    <?php if (!empty($enrolled_courses)): ?>
                        <div class="row">
                            <?php foreach ($enrolled_courses as $course): ?>
                                <div class="col-md-6 mb-3">
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">
                                                <i class="bi bi-journal-check"></i> 
                                                <?= esc($course['course_name']) ?>
                                            </h5>
                                            <p class="card-text text-muted mb-1">
                                                <strong>Instructor:</strong> <?= esc($course['course_instructor'] ?? 'N/A') ?>
                                            </p>
                                            <p class="card-text text-muted mb-0">
                                                <small><i class="bi bi-calendar-event"></i> Enrolled: <?= date('M d, Y', strtotime($course['enrollment_date'])) ?></small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> You are not enrolled in any courses yet. Browse available courses below!
                        </div>
                    <?php endif; ?>
                </div>

                <!-- =============================
                     AVAILABLE COURSES SECTION
                ================================== -->
                <div class="section-header mt-4">
                    <i class="bi bi-book text-warning"></i> Available Courses
                </div>

                <!-- Alert container for enrollment messages -->
                <div id="enrollmentAlert"></div>

                <div id="availableCoursesContainer">
                    <?php if (!empty($available_courses)): ?>
                        <div class="row">
                            <?php foreach ($available_courses as $course): ?>
                                <div class="col-md-6 mb-3" id="course-card-<?= $course['course_id'] ?>">
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <i class="bi bi-journal-text"></i> 
                                                <?= esc($course['course_name']) ?>
                                            </h5>
                                            <p class="card-text text-muted mb-3">
                                                <strong>Instructor:</strong> <?= esc($course['course_instructor']) ?>
                                            </p>
                                            <button 
                                                class="btn btn-primary btn-sm enroll-btn" 
                                                data-course-id="<?= $course['course_id'] ?>"
                                                data-course-name="<?= esc($course['course_name']) ?>">
                                                <i class="bi bi-plus-circle"></i> Enroll Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle"></i> Congratulations! You are enrolled in all available courses.
                        </div>
                    <?php endif; ?>
                </div>

                <!-- ====================
                     QUICK ACTIONS
                =========================-->
                <div class="section-header mt-4">
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

                <!-- ============================================
                     JQUERY + AJAX SCRIPT FOR ENROLLMENT
                ============================================= -->
                <!-- JQUERY + AJAX SCRIPT FOR ENROLLMENT -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Handle enrollment button click
    $('.enroll-btn').click(function() {
        const button = $(this);
        const courseId = button.data('course-id');
        const courseName = button.data('course-name');
        const courseInstructor = button.closest('.card-body').find('p:first').text().replace('Instructor: ', '').trim();
        
        // Disable button to prevent double-click
        button.prop('disabled', true).html('<i class="bi bi-hourglass-split"></i> Enrolling...');

        // AJAX POST request
        $.post('<?= base_url('course/enroll') ?>', 
            { 
                course_id: courseId,
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            },
            function(response) {
                if (response.success) {
                    // Show success message
                    $('#enrollmentAlert').html(
                        '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                        '<i class="bi bi-check-circle"></i> ' + response.message +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                        '</div>'
                    );

                    // Get current date for display
                    const today = new Date();
                    const dateStr = today.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });

                    // Create new enrolled course card
                    const newCourseCard = `
                        <div class="col-md-6 mb-3 newly-enrolled" style="display: none;">
                            <div class="card shadow-sm border-success">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">
                                        <i class="bi bi-journal-check"></i> 
                                        ${courseName}
                                    </h5>
                                    <p class="card-text text-muted mb-1">
                                        <strong>Instructor:</strong> ${courseInstructor}
                                    </p>
                                    <p class="card-text text-muted mb-0">
                                        <small><i class="bi bi-calendar-event"></i> Enrolled: ${dateStr}</small>
                                    </p>
                                    <span class="badge bg-success mt-2">Just Enrolled!</span>
                                </div>
                            </div>
                        </div>
                    `;

                    // Check if "My Enrolled Courses" is empty
                    const enrolledContainer = $('#enrolledCoursesContainer');
                    const hasNoEnrollments = enrolledContainer.find('.alert-info').length > 0;

                    if (hasNoEnrollments) {
                        // Replace the "no courses" message with a row
                        enrolledContainer.html('<div class="row" id="enrolled-courses-row"></div>');
                    }

                    // Add the new course card to enrolled section
                    $('#enrolledCoursesContainer .row').prepend(newCourseCard);
                    $('.newly-enrolled').slideDown(500);

                    // Update the total enrolled count in the banner
                    const currentCount = parseInt($('.role-banner p:first strong').next().text()) || 0;
                    $('.role-banner p:first').html('<strong>Total Enrolled Courses:</strong> ' + (currentCount + 1));

                    // Remove the course card from available courses with animation
                    $('#course-card-' + courseId).fadeOut(500, function() {
                        $(this).remove();
                        
                        // Check if there are no more available courses
                        if ($('#availableCoursesContainer .col-md-6').length === 0) {
                            $('#availableCoursesContainer').html(
                                '<div class="alert alert-success">' +
                                '<i class="bi bi-check-circle"></i> Congratulations! You are enrolled in all available courses.' +
                                '</div>'
                            );
                        }
                    });

                    // Remove "Just Enrolled" badge after 3 seconds
                    setTimeout(function() {
                        $('.newly-enrolled .badge').fadeOut(300, function() {
                            $(this).remove();
                        });
                        $('.newly-enrolled').removeClass('newly-enrolled');
                    }, 3000);

                } else {
                    // Show error message
                    $('#enrollmentAlert').html(
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        '<i class="bi bi-x-circle"></i> ' + response.message +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                        '</div>'
                    );
                    
                    // Re-enable button
                    button.prop('disabled', false).html('<i class="bi bi-plus-circle"></i> Enroll Now');
                }

                // Scroll to alert
                $('html, body').animate({
                    scrollTop: $('#enrollmentAlert').offset().top - 100
                }, 500);
            }
        ).fail(function(xhr) {
            // Handle server errors
            let errorMsg = 'An error occurred. Please try again.';
            
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMsg = xhr.responseJSON.message;
            }

            $('#enrollmentAlert').html(
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                '<i class="bi bi-x-circle"></i> ' + errorMsg +
                '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                '</div>'
            );
            
            // Re-enable button
            button.prop('disabled', false).html('<i class="bi bi-plus-circle"></i> Enroll Now');
        });
    });
});
</script>

            <?php endif; ?>

        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>