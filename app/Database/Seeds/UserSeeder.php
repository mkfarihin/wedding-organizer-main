<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        //untuk satu data
        // $data = [
        //     'name_user' => 'Administrator',
        //     'email_user' => '12217016@bsi.ac.id',
        //     'password_user' => password_hash('12345', PASSWORD_BCRYPT),
        // ];
        // $this->db->table('users')->insert($data);

        //untuk multi data
        $data = [
                [
                'name_user' => 'Administrator',
                'email_user' => 'adm@bsi.ac.id',
                'password_user' => password_hash('12345', PASSWORD_BCRYPT),
                ],
                [
                'name_user' => 'Administrator2',
                'email_user' => 'adm2@bsi.ac.id',
                'password_user' => password_hash('admin2', PASSWORD_BCRYPT),
                ],
            ];
            $this->db->table('users')->insertBatch($data);
    }
}
