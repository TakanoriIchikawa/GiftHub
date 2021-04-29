<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * currentUser function
     * ユーザー情報取得
     * @return json
     */
    public function currentUser()
    {
        return response()->json(Auth::user());
    }
}
