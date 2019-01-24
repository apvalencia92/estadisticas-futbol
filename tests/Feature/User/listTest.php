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

        $user = factory(User::class)->create();
        $user->assign('tecnico');

        $this->actingAs($admin)
            ->get('usuarios')
            ->assertViewIs('users.index')
            ->assertViewHas('users',function ($users) use ($user){
                return $users->contains($user);
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
           ->assertViewHas('user',function($user) use($tecnico){
               return  $user->id == $tecnico->id;
           });

   }


}
