<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    
    //Mostrar Formulario de Reiniciar Contraseña
    public function showLinkRequestForm()
    {
        return view('admin.passwords.email');
    }
    
    //Password Broker Admin Model
    public function broker()
    {
        return Password::broker('admins');
    }
}
