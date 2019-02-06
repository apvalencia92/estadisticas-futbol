<?php

use App\{User, Equipo};
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = factory(User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        $admin->assign('admin');


        $admin->assign('tecnico');

        $admin->equipos()->create([ 'name' => 'Independiente']);


        $tecnico = factory(User::class)->create([
            'name' => 'Técnico',
            'email' => 'tecnico@gmail.com',
            'password' => bcrypt('secret')
        ]);

        $tecnico->equipos()->create([
            'name' => 'Colombia F.C'
        ]);

        $tecnico->assign('tecnico');


        factory(User::class)->times(19)->create()->each(function ($user){
            $user->assign('tecnico');
            $user->equipos()->create(factory(Equipo::class)->raw());
        });
    }
}
