<?php

use App\Equipo;
use App\User;
use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade as Bouncer;

class BouncerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRoles();
        Bouncer::allow('admin')->everything();
        Bouncer::allow('tecnico')->toOwnEverything();
        Bouncer::allow('espectador')->toOwnEverything()->to('view');

    }

    protected function createRoles()
    {

        Bouncer::role()->create([
            'name' => 'admin',
            'title' => 'Administrador de todo el aplicativo'
        ]);

        Bouncer::role()->create([
            'name' => 'tecnico',
            'title' => 'Administrador del equipo'
        ]);

        Bouncer::role()->create([
            'name' => 'espectador',
            'title' => 'Espectador'
        ]);
    }

}
