<?php

namespace App\Http\Requests;

use App\Traits\ImageTrait;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserCreateRequest extends FormRequest
{

    use ImageTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'image' => ['nullable', 'image'],
            'password' => ['required', 'between:6,20'],
            'password_verify' => ['required', 'between:6,20', 'same:password'],

        ];
    }


    public function messages()
    {
        return [
            'password_verify.same' => 'Las contraseñas no coinciden'
        ];
    }


    public function createUser()
    {


        DB::transaction(function () {


            $data = $this->validated();

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'belongs_to_user' => auth()->id()
            ]);



            $user->assign('espectador');

            $user->equipos()->attach(auth()->user()->equipos()->first()->id);

            if ($this->hasFile('image')) {
                $data['image'] = "." . $this->file('image')->getClientOriginalExtension();

                $user->update(['image'=>$data['image']]);
                $this->tratarImagen($this->file('image'), $user);

            }




            return $user;


        });
    }
}
