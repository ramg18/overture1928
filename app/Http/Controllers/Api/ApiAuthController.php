<?php 

namespace App\Http\Controllers\Api;

use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function login(Request $request) {

        $request->validate([
            'email' => 'required|string|email|exists:users',
            'password' => 'required|string',
            //'remember_me' => 'boolean'
        ]);
        
        $credentials = request(['email', 'password']);
            
        if(!Auth::attempt($credentials))
        return response()->json([
            'contraseña' => 'la contraseña esta mal',
            'message' => 'La dirección de correo electrónico o contraseña que introdujo no es válida'
        ], 422);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
        {
            $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
        }

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'user' => $user,
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    public function register(Request $request)
    {
        // return $request->first_name;
        // $request->validate([
        //     'fName' => 'required|string',
        //     'lName' => 'required|string',
        //     'email' => 'required|string|email|unique:users',
        //     'password' => 'required|string'
        // ]);
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->rol = $request->rol;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function validarInvitacion( Request $request ) {
        $codigoactivo = CodigosRegistro::where('codigo', $request->codigo)
                                        ->first();
        
        if ( $codigoactivo->estado == 1 ) {
            $codigoactivo->estado = 0;
            $codigoactivo->save();
            return response()->json([
                'mensaje'   => 'código activo, procede a registrarte',
                'response'  => $codigoactivo
            ], 201);
           
        }else if( $codigoactivo->estado == 0){
            return response()->json([
                'message'   =>  'este código ya fue activado anteriormente',
                'body'      => $codigoactivo
            ], 401);
        }else{
            return response()->json([
                'message'   =>  'este código no existe en nuestra base de datos',
                'body'      => $codigoactivo
            ], 500);
        }

    }
}