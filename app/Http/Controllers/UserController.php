<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function checkAdmin($userId)
    {
        $user = User::find($userId);

        if ($user && $user->isAdmin()) {
            return "Это администратор!";
        } else {
            return "Это обычный пользователь.";
        }
    }
}
