<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;


    protected function setUp()
    {
        parent::setUp();
        $this->seed('BouncerSeeder');
    }

    protected function actinAsAdmin($admin = null)
    {
        if ($admin == null) {
            $admin = $this->createAdmin();
        }
        return $this->actingAs($admin);
    }


    protected function actinAsTecnico($tecnico = null)
    {
        if ($tecnico == null) {
            $tecnico = $this->createTecnico();
        }
        return $this->actingAs($tecnico);
    }



    protected function createAdmin(array $attributes = [])
    {
        return tap(factory(User::class)->create($attributes), function ($admin) {
            $admin->assign('admin');
        });
    }

    protected function createTecnico(array $attributes = [])
    {
        return tap(factory(User::class)->create($attributes), function ($user) {
            $user->assign('tecnico');
            $user->equipos()->create(['name' => 'equipo aleatorio']);
        });
    }

    protected function createEspectador($user = null)
    {
        if ($user == null) {
            $user = $this->createTecnico();
        }
        return tap(factory(User::class)->create(['belongs_to_user' => $user->id]), function ($user) {
            $user->assign('espectador');
        });
    }

    protected function withData(array $custom = [])
    {
        return array_merge($this->defaultData, $custom);
    }
}
