<?php

namespace Tests\Feature\User;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class createTest extends TestCase
{
    use RefreshDatabase;

    protected $defaultData = [
        'name' => 'Alex Valencia',
        'email' => 'alexvalencia91@gmail.com',
        'password' => '12345678'
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
        $this->withoutExceptionHandling();

        $tecnico = $this->createTecnico();

        $this->actingAs($tecnico);

        //1
        $this->post('usuarios',$this->withData())->assertRedirect('home');

        $usercreated = User::find(2);
        $usercreated->assign('espectador');
        $usercreated->equipos()->attach($tecnico->equipos()->first()->id);

        $this->assertDatabaseHas('users',[
            'name' => 'Alex Valencia',
            'email' => 'alexvalencia91@gmail.com',
        ]);


        //2
        $this->post('usuarios',$this->withData(['email'=>'other@gmail.com']))->assertRedirect('home');

        $usercreated2 = User::find(3);

        $this->assertDatabaseHas('users',[
            'name' => $usercreated2->name,
            'email' => $usercreated2->email
        ]);


     //3

        $this->post('usuarios',$this->withData(['email'=>'other2@gmail.com']))->assertRedirect('home');

        $usercreated3 = User::find(4);

        $this->assertDatabaseHas('users',[
            'name' => $usercreated3->name,
            'email' => $usercreated3->email
        ]);

    }

    /** @test */
    function tecnicos_no_pueden_crear_mas_de_tres_espectadores()
    {
        $tecnico = $this->createTecnico();

        $this->actingAs($tecnico);

        //1
        $this->post('usuarios',$this->withData(['email' => 'one@gmail.com']))->assertRedirect('home');
        $this->post('usuarios',$this->withData(['email' => 'two@gmail.com']))->assertRedirect('home');
        $this->post('usuarios',$this->withData(['email' => 'three@gmail.com']))->assertRedirect('home');


        $this->post('usuarios',$this->withData(['email' => 'for@gmail.com']))
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
