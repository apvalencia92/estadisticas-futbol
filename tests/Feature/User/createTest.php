<?php

namespace Tests\Feature\User;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class createTest extends TestCase
{


    protected $defaultData = [
        'name' => 'Alex Valencia',
        'email' => 'alexvalencia91@gmail.com',
        'password' => '12345678',
        'password_verify' => '12345678'
    ];


    /** @test */
    function tecnicos_pueden_ver_formulario_para_registrar_un_espectador()
    {
        $this->withoutExceptionHandling();

        $tecnico = $this->createTecnico();

        $this->actingAs($tecnico)
            ->get('usuarios/create')
            ->assertViewIs('users.create');
    }


    /** @test */
    function tecnicos_pueden_registrar_tres_espectadores()
    {

        $this->actingAs($this->createTecnico())
            ->post('usuarios', $this->withData())
            ->assertRedirect(route('usuarios.index'));


        $this->assertDatabaseHas('users', [
            'name' => 'Alex Valencia',
            'email' => 'alexvalencia91@gmail.com'
        ]);


        //2
        $this->post('usuarios', $this->withData(['email' => 'other@gmail.com']))->assertRedirect(route('usuarios.index'));

        $usercreated2 = User::find(3);

        $this->assertDatabaseHas('users', [
            'email' => 'other@gmail.com'
        ]);


        //3

        $this->post('usuarios', $this->withData(['email' => 'other2@gmail.com']))->assertRedirect(route('usuarios.index'));

        $usercreated3 = User::find(4);

        $this->assertDatabaseHas('users', [
            'email' => 'other2@gmail.com'
        ]);

    }

    /** @test */
    function tecnicos_no_pueden_crear_mas_de_tres_espectadores()
    {
        $tecnico = $this->createTecnico();

        $this->actingAs($tecnico);

        //1
        $this->post('usuarios', $this->withData(['email' => 'one@gmail.com']))->assertRedirect(route('usuarios.index'));
        $this->post('usuarios', $this->withData(['email' => 'two@gmail.com']))->assertRedirect(route('usuarios.index'));
        $this->post('usuarios', $this->withData(['email' => 'three@gmail.com']))->assertRedirect(route('usuarios.index'));


        $this->post('usuarios', $this->withData(['email' => 'for@gmail.com']))
            ->assertStatus(403);

    }


    /** @test */
    function usuario_espectador_no_puede_registrar_otros_espectadores()
    {

        $espectador = $this->createEspectador();

        $this->actingAs($espectador);

        $this->get('usuarios/create')
            ->assertStatus(403);

    }
}
