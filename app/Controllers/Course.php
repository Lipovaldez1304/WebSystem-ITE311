<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\EnrollmentModel;

class Course extends BaseController
{
    /**
     * Handle AJAX enrollment request
     */
    public function enroll()
    {
        // Security: Check if user is logged in
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized. Please log in.'
            ])->setStatusCode(401);
        }

        // Security: Only students can enroll
        $role = $session->get('role');
        if ($role !== 'student') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Only students can enroll in courses.'
            ])->setStatusCode(403);
        }

        // Get course_id from POST request
        $courseId = $this->request->getPost('course_id');

        // Validation: Check if course_id is provided and valid
        if (empty($courseId) || !is_numeric($courseId)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid course ID.'
            ])->setStatusCode(400);
        }

        $userId = $session->get('user_id');
        
        $courseModel = new CourseModel();
        $enrollmentModel = new EnrollmentModel();

        // Check if course exists
        $course = $courseModel->getCourseById($courseId);
        if (!$course) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Course not found.'
            ])->setStatusCode(404);
        }

        // Check if already enrolled
        if ($enrollmentModel->isAlreadyEnrolled($userId, $courseId)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'You are already enrolled in this course.'
            ])->setStatusCode(409);
        }

        // Enroll the user
        try {
            $enrollmentModel->enrollUser($userId, $courseId, $course['course_name']);
            
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Successfully enrolled in ' . esc($course['course_name']) . '!',
                'course' => $course
            ])->setStatusCode(200);
            
        } catch (\Exception $e) {
            log_message('error', 'Enrollment error: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'success' => false,
                'message' => 'An error occurred during enrollment. Please try again.'
            ])->setStatusCode(500);
        }
    }

    /**
     * Optional: View all courses (for future use)
     */
    public function index()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $courseModel = new CourseModel();
        $data['courses'] = $courseModel->getAllCourses();

        return view('courses/index', $data);
    }
}