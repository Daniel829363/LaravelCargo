<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Hash;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!isset($row['password'])) {
            $user=new User([
            'name'     => $row['name'],
            'number'    => $row['number'],
            'code'    => $row['code'],
            'email'    => $row['email'],
            'password' => Hash::make($row['code']),
        ]);
        }
        else{
        $user=new User([
            'name'     => $row['name'],
            'number'    => $row['number'],
            'code'    => $row['code'],
            'email'    => $row['email'],
            'password' => Hash::make($row['password']),
        ]);}
        return $user;
    }
}
