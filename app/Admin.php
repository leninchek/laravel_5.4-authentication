<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\AdminResetPasswordNotification;

class Admin extends Authenticatable
{
     use Notifiable;
     
    //Mass assignable attributes
    protected $fillable = [
        'name', 'email', 'password',
    ];
    
    //hidden attributes
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    //Send password reset notification
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }
}
