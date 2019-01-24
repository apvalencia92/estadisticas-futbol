<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 22/1/2019
 * Time: 10:51
 */

namespace App\Presenters;


use App\User;

class UserPresenter
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

}