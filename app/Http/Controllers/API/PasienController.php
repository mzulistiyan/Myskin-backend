<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Pasiens;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\PasswordValidationRules;

class PasienController extends Controller
{


    use PasswordValidationRules;

    
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                // Validasi input
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            // Cek credentials
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            }

            // Jika hash tidak sesuai maka beri error
            $pasien = Pasiens::where('email', $request->email)->first();
            if (!Hash::check($request->password, $pasien->password, [])) {
                throw new \Exception('Invalid Credentials');
            }

            $tokenResult = $pasien->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'pasien' => $pasien
            ], 'Authenticated');
            // Jika berhasil maka loginkan
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authenticated Failed', 500);
        }
    }


    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_pasien' => ['required', 'string', 'max:255'],
                'alamat' => ['required', 'string', 'max:255'],
                'jenis_kelamin' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:pasiens'],
                'password' => $this->passwordRules()
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            Pasiens::create([
                'nama_pasien' => $request->nama_pasien,
                'email' => $request->email,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'password' => Hash::make($request->password),
            ]);

            $pasien = Pasiens::where('email', $request->email)->first();

            return ResponseFormatter::success([
                'token_type' => 'Bearer',
                'pasien' => $pasien
            ]);
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success($token, 'Token Revoked');
    }

    public function fetchPasien(Request $request)
    {
        return ResponseFormatter::success($request->user(), 'Data Profile user berhasil diambil');
    }

    public function updateProfile(Request $request)
    {
        $data = $request->all();

        $user = Auth::user();
        $user->update($data);

        return ResponseFormatter::success($user, 'Profile Updated');
    }
}
