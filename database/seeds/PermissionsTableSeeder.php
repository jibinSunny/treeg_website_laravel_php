<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        $permissions = array(
            array("name" => "Create Users", "slug" => "create.users", "description" => "User Management", "model" => "NULL"),
            array("name" => "View Users", "slug" => "view.users", "description" => "User Management", "model" => "NULL"),
            array("name" => "Edit Users", "slug" => "edit.users", "description" => "User Management", "model" => "NULL"),
            array("name" => "Delete Users", "slug" => "delete.users", "description" => "User Management", "model" => "NULL"),
            array("name" => "Create Projects", "slug" => "create.projects", "description" => "NULL", "model" => "NULL"),
            array("name" => "View Projects", "slug" => "view.projects", "description" => "NULL", "model" => "NULL"),
            array("name" => "Edit Projects", "slug" => "edit.projects", "description" => "NULL", "model" => "NULL"),
            array("name" => "Delete Projects", "slug" => "delete.projects", "description" => "NULL", "model" => "NULL"),
            array("name" => "Create Project Category", "slug" => "create.project.category", "description" => "Project Category Management", "model" => "NULL"),
            array("name" => "View Project Category", "slug" => "view.project.category", "description" => "Project Category Management", "model" => "NULL"),
            array("name" => "Edit Project Category", "slug" => "edit.project.category", "description" => "Project Category Management", "model" => "NULL"),
            array("name" => "Delete Project Category", "slug" => "delete.project.category", "description" => "Project Category Management", "model" => "NULL"),
            array("name" => "Create NewsandEvents", "slug" => "create.newsandevents", "description" => "News And Events Management", "model" => "NULL"),
            array("name" => "View NewsandEvents", "slug" => "view.newsandevents", "description" => "News And Events Management", "model" => "NULL"),
            array("name" => "Edit NewsandEvents", "slug" => "edit.newsandevents", "description" => "News And Events Management", "model" => "NULL"),
            array("name" => "Delete NewsandEvents", "slug" => "delete.newsandevents", "description" => "News And Events Management", "model" => "NULL"),
            array("name" => "Create Testimonials", "slug" => "create.testimonials", "description" => "Testimonial Management", "model" => "NULL"),
            array("name" => "View Testimonials", "slug" => "view.testimonials", "description" => "Testimonial Management", "model" => "NULL"),
            array("name" => "Edit Testimonials", "slug" => "edit.testimonials", "description" => "Testimonial Management", "model" => "NULL"),
            array("name" => "Delete Testimonials", "slug" => "delete.testimonials", "description" => "Testimonial Management", "model" => "NULL"),
            array("name" => "Create Video Album", "slug" => "create.video.album", "description" => "Video Album Management", "model" => "NULL"),
            array("name" => "View Video Album", "slug" => "view.video.album", "description" => "Video Album Management", "model" => "NULL"),
            array("name" => "Edit Video Album", "slug" => "edit.video.album", "description" => "Video Album Management", "model" => "NULL"),
            array("name" => "Delete Video Album", "slug" => "delete.video.album", "description" => "Video Album Management", "model" => "NULL"),
            array("name" => "Create dashboard", "slug" => "create.dashboard", "description" => "NULL", "model" => "NULL"),
            array("name" => "View dashboard", "slug" => "view.dashboard", "description" => "NULL", "model" => "NULL"),
            array("name" => "Edit dashboard", "slug" => "edit.dashboard", "description" => "NULL", "model" => "NULL"),
            array("name" => "Delete dashboard", "slug" => "delete.dashboard", "description" => "NULL", "model" => "NULL"),
            array("name" => "Create Photo Album", "slug" => "create.photo.album", "description" => "Photo Album Management", "model" => "NULL"),
            array("name" => "View Photo Album", "slug" => "view.photo.album", "description" => "Photo Album Management", "model" => "NULL"),
            array("name" => "Edit Photo Album", "slug" => "edit.photo.album", "description" => "Photo Album Management", "model" => "NULL"),
            array("name" => "Delete Photo Album", "slug" => "delete.photo.album", "description" => "Photo Album Management", "model" => "NULL"),
            array("name" => "Create settings", "slug" => "create.settings", "description" => "Permission to roles and roles to users Management", "model" => "NULL"),
            array("name" => "View settings", "slug" => "view.settings", "description" => "Permission to roles and roles to users Management", "model" => "NULL"),
            array("name" => "Edit settings", "slug" => "edit.settings", "description" => "Permission to roles and roles to users Management", "model" => "NULL"),
            array("name" => "Delete settings", "slug" => "delete.settings", "description" => "Permission to roles and roles to users Management", "model" => "NULL"),
            array("name" => "View Customer Requests", "slug" => "view.customer.requests", "description" => "Customer Request Management", "model" => "NULL"),
            array("name" => "Edit Customer Requests", "slug" => "edit.customer.requests", "description" => "Customer Request Management", "model" => "NULL"),
            array("name" => "Delete Customer Requests", "slug" => "delete.customer.requests", "description" => "Customer Request Management", "model" => "NULL"),
            array("name" => "View Online Enquiries", "slug" => "view.online.enquiries", "description" => "Online Enquiries Management", "model" => "NULL"),
            array("name" => "Delete Online Enquiries", "slug" => "delete.online.enquiries", "description" => "Online Enquiries Management", "model" => "NULL"),
            array("name" => "Create Project Amenities", "slug" => "create.project.amenities", "description" => "NULL", "model" => "NULL"),
            array("name" => "View Project Amenities", "slug" => "view.project.amenities", "description" => "NULL", "model" => "NULL"),
            array("name" => "Edit Project Amenities", "slug" => "edit.project.amenities", "description" => "NULL", "model" => "NULL"),
            array("name" => "Delete Project Amenities", "slug" => "delete.project.amenities", "description" => "NULL", "model" => "NULL"),
            array("name" => "Create Location", "slug" => "create.location", "description" => "NULL", "model" => "NULL"),
            array("name" => "View Location", "slug" => "view.location", "description" => "NULL", "model" => "NULL"),
            array("name" => "Edit Location", "slug" => "edit.location", "description" => "NULL", "model" => "NULL"),
            array("name" => "Delete Location", "slug" => "delete.location", "description" => "NULL", "model" => "NULL")
        );
        Permission::insert($permissions);

         /*
         * Add Permissions
         *
         */
        // if (Permission::where('name', '=', 'Can View Users')->first() === null) {
        //     Permission::create([
        //         'name'        => 'Can View Users',
        //         'slug'        => 'view.users',
        //         'description' => 'Can view users',
        //         'model'       => 'Permission',
        //     ]);
        // }

        // if (Permission::where('name', '=', 'Can Create Users')->first() === null) {
        //     Permission::create([
        //         'name'        => 'Can Create Users',
        //         'slug'        => 'create.users',
        //         'description' => 'Can create new users',
        //         'model'       => 'Permission',
        //     ]);
        // }

        // if (Permission::where('name', '=', 'Can Edit Users')->first() === null) {
        //     Permission::create([
        //         'name'        => 'Can Edit Users',
        //         'slug'        => 'edit.users',
        //         'description' => 'Can edit users',
        //         'model'       => 'Permission',
        //     ]);
        // }

        // if (Permission::where('name', '=', 'Can Delete Users')->first() === null) {
        //     Permission::create([
        //         'name'        => 'Can Delete Users',
        //         'slug'        => 'delete.users',
        //         'description' => 'Can delete users',
        //         'model'       => 'Permission',
        //     ]);
        // }

        // //articles

        // if (Permission::where('name', '=', 'Can View Article')->first() === null) {
        //     Permission::create([
        //         'name'        => 'Can View Article',
        //         'slug'        => 'view.article',
        //         'description' => 'Can view article',
        //         'model'       => 'App\Article',
        //     ]);
        // }

        // if (Permission::where('name', '=', 'Can Create Article')->first() === null) {
        //     Permission::create([
        //         'name'        => 'Can Create Article',
        //         'slug'        => 'create.article',
        //         'description' => 'Can create new article',
        //         'model'       => 'App\Article',
        //     ]);
        // }

        // if (Permission::where('name', '=', 'Can Edit Article')->first() === null) {
        //     Permission::create([
        //         'name'        => 'Can Edit Article',
        //         'slug'        => 'edit.article',
        //         'description' => 'Can edit article',
        //         'model'       => 'App\Article',
        //     ]);
        // }

        // if (Permission::where('name', '=', 'Can Delete Article')->first() === null) {
        //     Permission::create([
        //         'name'        => 'Can Delete Article',
        //         'slug'        => 'delete.article',
        //         'description' => 'Can delete article',
        //         'model'       => 'App\Article',
        //     ]);
        // }
    }
}
