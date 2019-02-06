<?php

namespace Tests\Feature\Equipo;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class editTest extends TestCase
{


    /** @test */
    function tecnicos_pueden_ver_el_formulario_para_actualizar_informacion_del_equipo()
    {

        $tecnico = $this->createTecnico();
        $equipo = $tecnico->getEquipo();

        $this->actingAs($tecnico)
            ->get("equipos/{$equipo->id}/edit")
            ->assertViewIs('equipos.edit')
            ->assertViewHas('equipo', function ($equipoView) use ($equipo) {
                return $equipoView->id == $equipo->id;
            });
    }

    /** @test */
    function tecnicos_no_pueden_ver_el_formulario_para_actualizar_informacion_de_otro_equipo()
    {
        $tecnico = $this->createTecnico();

        $otroTecnico = $this->createTecnico();
        $otroEquipo = $otroTecnico->getEquipo();

        $this->actingAs($tecnico)
            ->get("equipos/{$otroEquipo->id}/edit")
            ->assertStatus(403);
    }


    /** @test */
    function tecnicos_actualizan_informacion_de_su_equipo()
    {
        $tecnico = $this->createTecnico();
        $equipo = $tecnico->getEquipo();

        $response = $this->actingAs($tecnico)
                ->put("equipos/$equipo->id", [
                    'name' => 'Independiente',
                    'fecha_nacimiento' => '1992-02-01'
                ]);

        $response->assertRedirect(route('equipos.show', $equipo));

//        $this->assertDatabaseHas('equipos', [
//            'name' => 'Independiente',
//            'fecha_nacimiento' => '1992-02-01'
//        ]);


    }
}
