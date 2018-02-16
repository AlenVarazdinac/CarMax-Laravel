<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $timestamps = false;
    public $remember_token = false;
    protected $primaryKey = 'user_id';

    public function getAuthPassword() {
        return $this->user_password;
    }
}
