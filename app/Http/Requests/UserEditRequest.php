<?php

namespace App\Http\Requests;

use App\Traits\ImageTrait;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class UserEditRequest extends FormRequest
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
            'name' => ['required','string'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->segment(2))],
            'image' => ['nullable', 'image'],
            'password' => ['nullable','between:6,20'],
            'password-confirm' => ['nullable','between:6,20','same:password']
        ];
    }


    public function updateUser(User $user)
    {


        DB::transaction(function () use ($user) {

            $data = $this->tratarPassword($this->validated());

            if ($this->hasFile('image')) {
                $this->tratarImagen($this->file('image'), $user);
                $data['image'] =  "." . $this->file('image')->getClientOriginalExtension();
            }

            $user->update($data);

        });


    }





}
