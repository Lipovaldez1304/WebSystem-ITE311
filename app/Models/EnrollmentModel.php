<?php

namespace App\Models;

use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table            = 'enrollments';
    protected $primaryKey       = 'enrollment_id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['user_id', 'course_id', 'course_name', 'enrollment_date'];
    protected $useTimestamps    = false;

    /**
     * Enroll a user in a course
     */
    public function enrollUser($userId, $courseId, $courseName)
    {
        $data = [
            'user_id'         => $userId,
            'course_id'       => $courseId,
            'course_name'     => $courseName,
            'enrollment_date' => date('Y-m-d H:i:s')
        ];

        return $this->insert($data);
    }

    /**
     * Check if user is already enrolled in a course
     */
    public function isAlreadyEnrolled($userId, $courseId)
    {
        return $this->where('user_id', $userId)
                    ->where('course_id', $courseId)
                    ->first() !== null;
    }

    /**
     * Get all courses a user is enrolled in
     */
    public function getUserEnrollments($userId)
    {
        return $this->select('enrollments.*, courses.course_instructor')
                    ->join('courses', 'courses.course_id = enrollments.course_id', 'left')
                    ->where('enrollments.user_id', $userId)
                    ->findAll();
    }

    /**
     * Get count of enrollments for a user
     */
    public function getUserEnrollmentCount($userId)
    {
        return $this->where('user_id', $userId)->countAllResults();
    }
    

    /**
     * Unenroll a user from a course (optional - for future use)
     */
    public function unenrollUser($userId, $courseId)
    {
        return $this->where('user_id', $userId)
                    ->where('course_id', $courseId)
                    ->delete();
    }
}