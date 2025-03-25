<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Define roles
        $roles = ['Admin', 'Vendor', 'Customer'];
        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
                'slug' => Str::slug($role),
                'created_at' => now(),
            ]);
        }

        // Create admin
        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@admin.com';
        $admin->password = Hash::make('admin');
        $admin->created_at = now();

        $admin->save();

        $adminRole = Role::where('slug', 'admin')->first();
        $admin->roles()->attach($adminRole);

        // Create vendor
        $vendor = new User();
        $vendor->name = 'Vendor';
        $vendor->email = 'vendor@vendor.com';
        $vendor->password = Hash::make('vendor');
        $vendor->created_at = now();

        $vendor->save();

        $vendorRole = Role::where('slug', 'vendor')->first();
        $vendor->roles()->attach($vendorRole);

        // Create customers
        User::factory(15)->create();
    }
}
