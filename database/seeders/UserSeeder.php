<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Model::unguard();
        $users = [
            'admin@user.com'    => array(
                'name' => 'Sayem Khan',
                'role' => UserType::ADMIN,
                'display_name' => 'Admin',
            ),
            'merchant@user.com' => array(
                'name' => 'Mutasim Billah',
                'role' => UserType::MERCHANT,
                'display_name' => 'Merchant',
            ),
            'waiter@user.com'   => array(
                'name' => 'Abul',
                'role' => UserType::WAITER,
                'display_name' => 'Waiter',
            ),
            'customer@user.com' => array(
                'name' => 'Mr.khan',
                'role' => UserType::CUSTOMER,
                'display_name' => 'Customer',
            ),
        ];
        $i = 0;
        foreach ($users as $user) {
            /** @var User $model */
            $model = User::query()->create(
                [
                    'name'              => $user['name'],
                    'phone'             => '0167533946' . $i++,
                    'firebase_token'    => $user['name'] . '_' . 'token',
                    'phone_verified_at' => now(),
                ]
            );
            /** @var Role $role */
            $role = Role::query()->create(
                [
                    'name'         => $user['role'],
                    'display_name' => $user['display_name'],
                ]
            );
            $model->attachRole($role);
        }
        Model::reguard();
    }
}
