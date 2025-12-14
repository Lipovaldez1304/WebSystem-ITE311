<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table            = 'courses';
    protected $primaryKey       = 'course_id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['course_name', 'course_instructor'];
    protected $useTimestamps    = false;

    /**
     * Get all courses
     */
    public function getAllCourses()
    {
        return $this->findAll();
    }

    /**
     * Get a single course by ID
     */
    public function getCourseById($courseId)
    {
        return $this->find($courseId);
    }

    /**
     * Get courses that a specific user is NOT enrolled in
     */
    public function getAvailableCoursesForUser($userId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        
        return $builder
            ->select('courses.*')
            ->join('enrollments', 'enrollments.course_id = courses.course_id', 'left')
            ->where('enrollments.user_id !=', $userId)
            ->orWhere('enrollments.user_id', null)
            ->groupBy('courses.course_id')
            ->get()
            ->getResultArray();
    }

    /**
     * Alternative: Get courses not enrolled by user using NOT IN
     */
    public function getCoursesNotEnrolledByUser($userId)
    {
        $enrollmentModel = new \App\Models\EnrollmentModel();
        $enrolledCourseIds = $enrollmentModel
            ->select('course_id')
            ->where('user_id', $userId)
            ->findColumn('course_id');

        if (empty($enrolledCourseIds)) {
            return $this->findAll();
        }

        return $this->whereNotIn('course_id', $enrolledCourseIds)->findAll();
    }
}