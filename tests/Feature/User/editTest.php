<?php

namespace Tests\Feature\User;


use Illuminate\Support\Facades\Gate;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class editTest extends TestCase
{

    use RefreshDatabase;

   /** @test */
   function tecnicos_pueden_ver_formulario_para_editar_informacion_de_los_espectadores()
   {
//       self::markTestIncomplete();

       $tecnico = $this->createTecnico();
       $espectador = $this->createEspectador($tecnico);


        $this->actinAsTecnico($tecnico)
            ->get("usuarios/$espectador->id/edit")
            ->assertViewIs('users.edit')
            ->assertStatus(200)
            ->assertSee($espectador->email);

       $this->assertTrue(Gate::allows('update',$espectador));

   }


   /** @test */
   function tecnicos_pueden_editar_un_espectador()
   {

       $tecnico = $this->createTecnico();
       $espectador = $this->createEspectador($tecnico);

       $response = $this->actinAsTecnico($tecnico)
           ->put("usuarios/$espectador->id",[
               'name' => 'Espectador Editado',
               'email' => 'emaileditado@gmail.com',
               'password' => 'secret2'
           ]);

       $response->assertRedirect(route('usuarios.show',$espectador->id));

       $this->assertCredentials([
           'name' => 'Espectador Editado',
           'email' => 'emaileditado@gmail.com',
           'password' => 'secret2'
       ]);

   }

}
