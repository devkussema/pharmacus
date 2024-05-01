<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class GetUserController extends Controller
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserWithId(Request $request, $id)
    {
        return User::find($id);
    }
}
