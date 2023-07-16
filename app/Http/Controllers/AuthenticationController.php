<?php

namespace App\Http\Controllers;

use App\Events\UserJoinedTheChat;
use App\Http\Requests\RegisterAndLoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{


    public function registerAndLogin(RegisterAndLoginRequest $request): JsonResponse
    {
        $data = $request->validated();


        $user = User::create($data);
        $token = $user->createToken(time())->plainTextToken;
        return response()->json(compact('user','token'));
    }
}
