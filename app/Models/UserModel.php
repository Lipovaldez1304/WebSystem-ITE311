<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;

    protected $allowedFields = ['name', 'email', 'password', 'role', 'is_restricted', 'session_version'];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword', 'checkRoleChange'];

    /* ---------------------------------------------------
     | PASSWORD HASHER
     --------------------------------------------------- */
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password']) && !empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        } else {
            if (isset($data['data']['password']) && empty($data['data']['password'])) {
                unset($data['data']['password']);
            }
        }

        return $data;
    }

    /* ---------------------------------------------------
     | INCREMENT SESSION VERSION IF ROLE CHANGED
     --------------------------------------------------- */
    protected function checkRoleChange(array $data)
    {
        // Only increment if role is being changed
        if (isset($data['data']['role']) && isset($data['id'])) {
            $user = $this->find($data['id'][0]);
            if ($user && $user['role'] !== $data['data']['role']) {
                $data['data']['session_version'] = ($user['session_version'] ?? 0) + 1;
            }
        }
        
        return $data;
    }

    /* ---------------------------------------------------
     | ROLE COUNTS (For Dashboard)
     --------------------------------------------------- */
    public function countByRole($role)
    {
        return $this->where('role', $role)
                    ->where('is_restricted', 0)
                    ->countAllResults();
    }

    public function countRestricted()
    {
        return $this->where('is_restricted', 1)
                    ->countAllResults();
    }

    /* ---------------------------------------------------
     | GET ALL ROLE COUNTS (For Admin Dashboard)
     --------------------------------------------------- */
    public function getRoleCounts()
    {
        return [
            'admin'      => $this->countByRole('admin'),
            'teacher'    => $this->countByRole('teacher'),
            'student'    => $this->countByRole('student'),
            'restricted' => $this->countRestricted(),
        ];
    }
}
