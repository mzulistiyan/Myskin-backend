<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Dokters;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\PasswordValidationRules;

class DokterController extends Controller
{
    use PasswordValidationRules;

    public function getAllDokter(Request $request)
    {
        try {
            $dokter =  DB::table('dokters')->get();
            return ResponseFormatter::success([
                'token_type' => 'Bearer',
                'dokter' => $dokter,
            ], 'Get Data Dokter berhasil');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], ' Get Data Dokter Gagal', 500);
        }
    }
    
    public function loginDokter(Request $request)
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
            if (!Auth::guard('dokter')->attempt($credentials)) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ],'Authentication Failed', 500);
            }

            // Jika hash tidak sesuai maka beri error
            $dokter = Dokters::where('email', $request->email)->first();
            if (!Hash::check($request->password, $dokter->password, [])) {
                throw new \Exception('Invalid Credentials');
            }

            $tokenResult = $dokter->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'dokter' => $dokter
            ], 'Authenticated');
            // Jika berhasil maka loginkan
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authenticated Failed', 500);
        }
    }


    public function registerDokter(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_dokter' => ['required', 'string', 'max:255'],
                'NIK' => ['required', 'string',],
                'jenis_kelamin' => ['required', 'string', 'max:255'],
                'telp' => ['required', 'string', 'max:255'],
                'rumah_sakit' => ['required', 'string', 'max:255'],
                'no_STR' => ['required'],
                'no_SIP' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:pasiens'],
                'password' => $this->passwordRules()
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            Dokters::create([
                'nama_dokter' => $request->nama_dokter,
                'email' => $request->email,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'rumah_sakit' => $request->rumah_sakit,
                'telp' => $request->telp,
                'no_STR' => $request->no_STR,
                'no_SIP' => $request->no_SIP,
                'NIK' => $request->NIK,
                'password' => Hash::make($request->password),
            ]);

            $dokter = Dokters::where('email', $request->email)->first();

            return ResponseFormatter::success([
                'token_type' => 'Bearer',
                'dokter' => $dokter
            ],'Registrasi Success');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function logoutDokter(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success($token, 'Token Revoked');
    }

    public function getDokter(Request $request)
    {
        return ResponseFormatter::success($request->user(), 'Data Profile user berhasil diambil');
    }

    public function updateDokter(Request $request)
    {
        $data = $request->all();

        $user = Auth::user();
        $user->update($data);

        return ResponseFormatter::success($user, 'Profile Updated');
    }

    public function changePasswordDokter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Validasi input
            'old_password' => 'required',
            'password' => 'required',
            'confirmation_password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user = $request->user();
        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return ResponseFormatter::success([
                'message' => 'Password berhasil diubah'
            ],'Password berhasil diubah');

        } else{
            return ResponseFormatter::error([
                'message' => 'Password lama tidak sesuai'
            ],'Password lama tidak sesuai');
        }
    }
}
