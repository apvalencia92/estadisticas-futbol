<?php

namespace Tests\Feature\Equipo;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class listTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admin_pueden_listar_todos_los_equipos()
    {

        $this->withoutExceptionHandling();

        $tecnico = $this->createTecnico();
        $equipo = $tecnico->equipos()->first();

        $this->actingAs($this->createAdmin())
            ->get('/equipos')
            ->assertStatus(200)
            ->assertViewIs('equipos.index')
            ->assertViewHas('equipos', function ($equipos) use ($equipo) {
                return $equipos->contains($equipo);
            });

    }


    /** @test */
    function tecnicos_no_pueden_ver_listado_de_equipos()
    {
        $this->actingAs($this->createTecnico())
            ->get('/equipos')
            ->assertStatus(403);
    }


    /** @test */
    function tecnicos_pueden_ver_el_detalle_de_su_equipo()
    {
        $tecnico = $this->createTecnico();
        $equipo = $tecnico->equipos()->first();


        $this->actingAs($tecnico)
            ->get("equipos/{$equipo->id}")
            ->assertStatus(200)
            ->assertViewIs('equipos.show')
            ->assertViewHas('equipo', function ($equipoView) use ($equipo) {
                return $equipoView->id == $equipo->id;
            });

    }


}
