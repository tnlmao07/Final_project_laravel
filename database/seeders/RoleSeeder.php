<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Hardcoding the roles values as mentioned in the requirements document using seeder */
        $arr=['Super_Admin','Admin','Inventory_Manager','Order_Manager','Customer'];

        foreach($arr as $a){
        Role::create([
            'name' => $a
        ]);
        }
    }
}
