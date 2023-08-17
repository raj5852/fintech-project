<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'dashboard',
            'pending-user',
            'category',
            'discussion',
            'brands',
            'products',
            'orders',
            'memberships',
            'manage-wallet',
            'request-product',
            'coupon',
            'testimonial',
            'subscriber',
            'home-page-setting',
            'manage-api',
            'privacy-policy',
            'about-page',
            'all-contact',
            'database-backup',
            'notification',
            'group'
         ];

         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
