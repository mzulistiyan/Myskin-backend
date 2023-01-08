<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Pasiens;
use App\Models\TesKesehatans;
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

    public function loginPasien(Request $request)
    {
        try {
            //Memvalidasi Email Password Benar Atau Tidak
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);
            //Jika Validator False, Akan memunculkan Response error dengan code 400
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            // Mengecek credentials
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

            //Create Token Untuk Login
            $tokenResult = $pasien->createToken('authToken')->plainTextToken;

            //Jika berjasil maka akan beri response JSON yang akan diconsume oleh frontend
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

    public function tesKesehatanKulit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'diagnosa_sementara' => ['required', 'string', 'max:255'],
                
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $id = Auth::user()->id_pasien;
            TesKesehatans::create([
                'id_pasien' => $id,
                'diagnosa_sementara' => $request->diagnosa_sementara,
            ]);

            return ResponseFormatter::success([
            ],'Tes Kesehatan Success');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function getTesKesehatanKulit(Request $request)
    {
        try {
            $consult = TesKesehatans::with(['pasien'])
            ->where('id_pasien', Auth::user()->id_pasien);

            return ResponseFormatter::success(
                $consult->get(),
                'Data list konsultasi berhasil diambil'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error($error->getMessage(), 'Data list konsultasi Gagal');
        }
    }


    public function registerPasien(Request $request)
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
            ],'Registrasi Success');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function logoutPasien(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success($token, 'Token Revoked');
    }

    public function getDataPasien(Request $request)
    {
        return ResponseFormatter::success($request->user(), 'Data Profile user berhasil diambil');
    }

    public function updatePasien(Request $request)
    {
        $data = $request->all();

        $user = Auth::user();
        $user->update($data);

        return ResponseFormatter::success($user, 'Profile Updated');
    }

    public function gantiPassword(Request $request)
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
