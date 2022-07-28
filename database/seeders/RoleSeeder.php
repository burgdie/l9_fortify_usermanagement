<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //Role::factory->times(10)->create();

       /**
        * We call the DB Facade and will define:
        * On the table of roles we want to insert
        * and then we can pass in an array into this insert
        * and then we give it the name of the columns
        * and the data we want to put in
        * the first column it is called name and in there we want to insert
        * a new row with the value of Admin
        * We will create two more with the data Author and the data User
        *
        * Now the final thing we want to do is add these into our database seeder
        * Adding them all to the database seeder is normally what most people
        * want to do as that will call all of the seeds addded  into there in one go.
        * So let's just open the Databaseseeder File
        */

       DB::table('roles')->insert([
        'name' => 'Admin'
       ]);

       DB::table('roles')->insert([
        'name' => 'Author'
       ]);

       DB::table('roles')->insert([
        'name' => 'User'
       ]);
    }
}
