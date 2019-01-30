<?php

namespace Tests\Feature\User;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class listTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function administradores_pueden_ver_listado_de_tecnicos()
    {
        $admin = $this->createAdmin();

        $usuario = factory(User::class)->create();
        $usuario->assign('tecnico');

        $this->actingAs($admin)
            ->get('usuarios')
            ->assertViewIs('users.index')
            ->assertViewHas('usuarios', function ($usuarios) use ($usuario) {
                return $usuarios->contains($usuario);
            });
    }


    /** @test */
    function administradores_pueden_ver_detalles_de_los_usuarios()
    {
        $tecnico = $this->createTecnico();

        $this->actinAsAdmin()
            ->get("usuarios/{$tecnico->id}")
            ->assertStatus(200)
            ->assertViewIs('users.show')
            ->assertViewHas('usuario', function ($usuario) use ($tecnico) {
                return $usuario->id == $tecnico->id;
            });

    }


    /** @test */
    function tecnicos_pueden_ver_sus_espectadores()
    {
        $tecnico = $this->createTecnico();

        $espectador1 = $this->createEspectador($tecnico);
        $espectador2 = $this->createEspectador($tecnico);

        $this->actingAs($tecnico)
            ->get('/usuarios')
            ->assertStatus(200)
            ->assertViewHas('usuarios', function ($usuarios) use ($espectador1, $espectador2) {
                return $usuarios->contains($espectador1) && $usuarios->contains($espectador2);
            });

    }

    /** @test */
    function tecnicos_pueden_ver_el_detalle_de_su_espectador()
    {
        $tecnico = $this->createTecnico();

        $espectador = $this->createEspectador($tecnico);

        $this->actingAs($tecnico)
            ->get("usuarios/$espectador->id")
            ->assertStatus(200)
            ->assertViewHas('usuario', function ($usuario) use ($espectador) {
                return $usuario->id == $espectador->id;
            });

    }


    /** @test */
    function tecnicos_no_pueden_ver_otros_espectadores()
    {
        $tecnico = $this->createTecnico();

        $espectador = $this->createEspectador();

        $this->actingAs($tecnico)
            ->get('/usuarios')
            ->assertDontSee($espectador->name)
            ->assertViewHas('usuarios', function ($usuarios) use ($espectador) {
                return !$usuarios->contains($espectador);
            });

    }


    /** @test */
    function tecnicos_no_pueden_ver_el_detalle_de_otro_espectador()
    {
        $tecnico = $this->createTecnico();

        $espectadorOther = $this->createEspectador();

        $this->actingAs($tecnico)
            ->get("usuarios/$espectadorOther->id")
            ->assertStatus(403);

    }


}
