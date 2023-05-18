<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions

        // For job seekers
        Permission::create(['name' => 'create applications']);

        // For employers
        Permission::create(['name' => 'edit gigs']);
        Permission::create(['name' => 'delete gigs']);

        $employer = Role::create(['name' => 'employer']);
        $employer->givePermissionTo('edit gigs');
        $employer->givePermissionTo('delete gigs');

        $seeker = Role::create(['name' => 'seeker']);
        $seeker->givePermissionTo('create applications');

        // // Demo user

        // $user = \App\Models\User::factory()->create([
        //     'name' => 'Example User',
        //     'email' => 'test@example.com',
        // ]);
        // $user->assignRole($employer);

    }
}
