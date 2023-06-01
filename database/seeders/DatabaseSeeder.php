<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tag;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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

        // Tags seeding

        // Experience tags
        Tag::create(['type' => 'experience', 'name' => 'Trainee']);
        Tag::create(['type' => 'experience', 'name' => 'Junior']);
        Tag::create(['type' => 'experience', 'name' => 'Mid']);
        Tag::create(['type' => 'experience', 'name' => 'Senior']);
        Tag::create(['type' => 'experience', 'name' => 'Expert']);

        // Category tags
        Tag::create(['type' => 'category', 'name' => 'Back-end']);
        Tag::create(['type' => 'category', 'name' => 'Front-end']);
        Tag::create(['type' => 'category', 'name' => 'Full-stack']);
        Tag::create(['type' => 'category', 'name' => 'Mobile']);
        Tag::create(['type' => 'category', 'name' => 'AI']);
        Tag::create(['type' => 'category', 'name' => 'Design']);
        Tag::create(['type' => 'category', 'name' => 'DevOps']);
        Tag::create(['type' => 'category', 'name' => 'Game-dev']);
        Tag::create(['type' => 'category', 'name' => 'ERP']);
        Tag::create(['type' => 'category', 'name' => 'Automation']);
        Tag::create(['type' => 'category', 'name' => 'Security']);
        Tag::create(['type' => 'category', 'name' => 'Architecture']);

        // Technology tags
        Tag::create(['type' => 'technology', 'name' => '.NET']);
        Tag::create(['type' => 'technology', 'name' => 'JavaScript']);
        Tag::create(['type' => 'technology', 'name' => 'SQL']);
        Tag::create(['type' => 'technology', 'name' => 'Java']);
        Tag::create(['type' => 'technology', 'name' => 'Python']);
        Tag::create(['type' => 'technology', 'name' => 'C++']);
        Tag::create(['type' => 'technology', 'name' => 'PHP']);
        Tag::create(['type' => 'technology', 'name' => 'HTML']);
        Tag::create(['type' => 'technology', 'name' => 'Vue.js']);
        Tag::create(['type' => 'technology', 'name' => 'Ruby']);
        Tag::create(['type' => 'technology', 'name' => 'C']);
        Tag::create(['type' => 'technology', 'name' => 'React']);
    }
}
