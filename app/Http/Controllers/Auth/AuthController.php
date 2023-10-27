<?php

namespace App\Http\Controllers\Auth;

use App\Constants\ErrorMessage;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;
use Tymon\JWTAuth\JWTAuth;
use App\Constants\Status;
use App\Services\Person\UserService;
use Error;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    protected JWTAuth $jwt;
    protected UserService $userService;
    public function __construct(
        JWTAuth $jwt,
        UserService $userService
    ) {
        $this->jwt = $jwt;
        $this->userService = $userService;
        $this->middleware('auth:api', ['except' => ['login']]);
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6|max:20',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (!$token = $this->jwt->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = auth()->user();
        return response()->json($user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['status'=> Status::SUCCESS, 'message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $token = auth()->refresh();
        return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {

        return response()->json([
            'user' => auth()->user(),
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    
    public function update(Request $request)
    {
        $req = $request->all();

        if (isset($req['newpassword'])) {
            $req['email'] = auth()->user()['email'];
            return $this->updatePassword($request, $req['newpassword']);
        } else if (isset($req['newemail'])) {
            
            return $this->updateEmail($request, $req['newemail']);
        } else if (isset($req['name'])) {
            return $this->updatePerfil($request);
        } else {
            $data = ['status' => Status::ERROR, "message" => ErrorMessage::FAIL];
            $this->responseWithJsonDefault($data, $data['status']);
        }
    }

    protected function updatePassword($req, $newPassword)
    {
        $this->validate($req, [
            'password' => 'required|min:6|max:20',
            'newpassword' => 'required|min:6|max:20',
        ]);
        $credentials = $req->only(['email', 'password']);
        if (auth()->validate($credentials)) {
            $id = auth()->user()['id'];
            $data = $this->userService->updatePassword($newPassword, $id);
            return $this->responseWithJsonDefault($data, $data['status']);
        } else {
            $data = ['status' => Status::UNAUTHORIZED, 'message' => ErrorMessage::USER_UNAUTHORIZED_FUNCTION];
            return $this->responseWithJsonDefault($data, Status::UNAUTHORIZED);
        }
    }


    protected function updateEmail($req, $newEmail)
    {

        $this->validate($req, [
            'email' => 'required|email',
            'newemail' => 'required|email',
            'password' => 'required|min:6|max:20'
        ]);
        $credentials = $req->only(['email', 'password']);
        $email = auth()->user()['email'];
        
        if (auth()->validate($credentials) && $credentials['email'] == $email) {
            
            $id = auth()->user()['id'];
            $data = $this->userService->updateEmail($newEmail, $id);
            return $this->responseWithJsonDefault($data, $data['status']);
        } else {
            $data = ['status' => Status::UNAUTHORIZED, 'message' => ErrorMessage::USER_UNAUTHORIZED_FUNCTION];
            return $this->responseWithJsonDefault($data, Status::UNAUTHORIZED);
        }
    }

    protected function updatePerfil($req)
    {
        $this->validate($req, [
            'name' => 'required',
            'address.rua' => 'required',
            'address.number' => 'required',
            'address.cep' => 'required',
            'address.city_id' => 'required',
        ]);
        $data = $req->only(['name', 'address']);
        $id = auth()->user()['id'];
        $data = $this->userService->update($data, $id);
        return $this->responseWithJsonDefault($data, $data['status']);
    }


    protected function responseWithJsonDefault($data, $status): JsonResponse
    {
        if (isset($status, $data))
            switch ($status) {
                case Status::SUCCESS:
                    return response()->json($data, 200);
                    break;

                case Status::ERROR:
                    return response()->json($data, 500);
                    break;

                case Status::UNAUTHORIZED:
                    return response()->json($data, 401);
                    break;

            }
            
        return response()->json([
            'status' => Status::ERROR,
            'error' => ErrorMessage::FAIL
        ], 500);
    }
}
