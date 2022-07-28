<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * When we have our roles and users in the database, the final thing we want to do
         * is to link these together in tour many to many relationship fow which
         * the RoleUserSeeder is used
         * Now on the top of this file we will bring in our Uer and Role Model
         * The first thing we want to do is get all of the roles out of the database
         * An now we will get all of the users and populate the pivot table wit one of the
         *  roles
         * So what we can do is to call teh User Model and get all users in a collection so
         * we can use the each method on this
         * where we can say for each of these users we will run an anonymous function
         * on them we jst need to pass in the user and we also want to use the roles
         * and inside of this closure and say this current user with inside of each loop
         * we can call our roles relationship and we can say we want to attach a role to
         * this user
         * So we are saying to our Eloquent here we want to attach whatever we put in the
         * roles relationship on the user model
         * So we got our roles and we passing these in here
         * So we can just day $roles and agian this is a collection so we have access
         * to the method of random
         * so we can say her pick one item from this roles collection here and then
         * we want to pluck the id from that collection so that the moment we have
         * three roles in our database, so pull one out of this collection and if we got one
         * we want to have the id which willreturn us 1, 2 or 3
         * This will be then attched to the roles relationship on the user model
         * So over in our DatabaseSeeder
         */

        $roles = Role::all();

        User::all()->each(function($user) use ($roles) {
            $user->roles()->attach(
                $roles->random(1)->pluck('id')
            );
        });
    }
}
