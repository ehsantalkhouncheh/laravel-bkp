<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::create([
            'name'=>'Ehsan',
            'email'=>'ehsan.bagherzadegan@ebuero.ag',
            'Password'=>bcrypt('Test@123')
        ]);
        $user->assignRole('Admin');

        $user=User::create([
            'name'=>'Hossein',
            'email'=>'h.bagherzadegan@ebuero.ag',
            'Password'=>bcrypt('Test@123')
        ]);
        $user->assignRole('Admin');

        $user=User::create([
            'name'=>'Arturo',
            'email'=>'arturo.chaves-maza@ebuero.ag',
            'Password'=>bcrypt('Test@123')
        ]);
        $user->assignRole('Admin');

        $user=User::create([
            'name'=>'Tania',
            'email'=>'t.de-sousa-lopes@clbs.co.th',
            'Password'=>bcrypt('Test@123')
        ]);
        $user->assignRole('Admin');

        $user=User::create([
            'name'=>'Jang',
            'email'=>'nidcha.injai@clbs.co.th',
            'Password'=>bcrypt('Test@123')
        ]);
        $user->assignRole('Admin');

        $user=User::create([
            'name'=>'Bright',
            'email'=>'n.pipatwasukun@clbs.co.th',
            'Password'=>bcrypt('Test@123')
        ]);
        $user->assignRole('Admin');

    }
}
