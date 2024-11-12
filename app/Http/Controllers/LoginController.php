<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\MahasiswaKtm;
use App\Models\ShortenerURL;
use Illuminate\Http\Request;
use App\Models\MahasiswaDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    function index()
    {
        return view('login.index');
    }

    function generateLoginURL(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $wa = str_replace('@c.us', '', $data['hp']);
        $hp = '0' . substr($wa, 2);

        $user  = MahasiswaDetail::where('hp', $hp)->join('m_mahasiswa', 't_mahasiswa_detail.mahasiswa_id', '=', 'm_mahasiswa.id')->select('t_mahasiswa_detail.*', 'm_mahasiswa.nama')->orderBy('t_mahasiswa_detail.created_at', 'desc')->first();

        if ($user) {
            $otp = bin2hex(random_bytes(3));
            $user->otp = $otp;
            $user->save();

            // generate keyword
            $keyword = bin2hex(random_bytes(5));

            $url  = 'https://siakad.poltekbatu.ac.id/login-process/' . $user->hp . '/' . $otp;
            $so = new ShortenerURL;
            $so->keyword = $keyword;
            $so->url = $url;
            $so->ip = $request->ip();
            $so->clicks = 0;
            $so->save();

            $urlNow = 'https://so.poltekbatu.ac.id/' . $keyword;
            // $urlNow = 'http://192.168.18.75/' . $keyword;
            $res = array(
                'url' => $urlNow,
                'nama' => $user->nama,
            );

            return response($res, 200);
        } else {
            return response('null', 404);
        }
    }

    function loginProcess($hp, $otp)
    {
        // Find user and check if OTP is valid
        $user = Mahasiswa::join('t_mahasiswa_detail', 't_mahasiswa_detail.mahasiswa_id', '=', 'm_mahasiswa.id')
            ->where('t_mahasiswa_detail.hp', $hp)
            ->select('t_mahasiswa_detail.*', 'm_mahasiswa.*')
            ->orderBy('t_mahasiswa_detail.created_at', 'desc')
            ->first();

        if (!$user || $user->otp !== $otp) {
            // Clear OTP and redirect on failure
            MahasiswaDetail::where('mahasiswa_id', $user->mahasiswa_id)->update(['otp' => null, 'session_id' => null]);
            return redirect()->route('login')->with('error', 'Ada kesalahan, silahkan coba lagi');
        }

        // Generate and save new LMS password
        $passwordLMS = Str::random(8);
        $user->password_lms = bcrypt($passwordLMS); // Hash password for security
        $user->save();

        // Store LMS credentials and session flag for frontend password update
        session([
            'update_lms_password' => true,
            'lms_credentials' => [
                'username' => $user->nim,
                'password' => $passwordLMS,
            ]
        ]);

        // Clear OTP after successful verification
        MahasiswaDetail::where('mahasiswa_id', $user->mahasiswa_id)->update(['otp' => null]);

        // Manage session and logout from previous sessions if any
        $new_session_id = Session::getId();
        $last_session = Session::getHandler()->read($user->session_id);
        if ($last_session) {
            Session::getHandler()->destroy($user->session_id);
            Auth::guard('mahasiswa')->logout();
        }

        // Update the current session and save user information to session
        MahasiswaDetail::where('mahasiswa_id', $user->mahasiswa_id)->update(['session_id' => $new_session_id]);
        Session::put([
            'mahasiswa_id' => $user->mahasiswa_id,
            'nama' => $user->nama,
            'nim' => $user->nim,
            'email' => $user->email,
            'ktm_path' => optional(MahasiswaKtm::where('mahasiswa_id', $user->mahasiswa_id)->where('status', 2)->first())->path_photo,
        ]);

        // Authenticate the user
        Auth::guard('mahasiswa')->loginUsingId($user->mahasiswa_id);

        return redirect()->route('home');
    }


    public function clearLmsPasswordSession()
    {
        session()->forget('update_lms_password');
        return response()->json(['status' => 'session cleared']);
    }

    public function proxyUpdatePassword(Request $request)
    {
        try {
            // Send POST request to LMS API
            $response = Http::post('https://lms.poltekbatu.ac.id/user/interpreterUpdatePasswordDARe5.php', [
                'username' => $request->username,
                'password' => $request->password,
            ]);

            // Check if the response is successful
            if ($response->successful()) {
                return response()->json(['message' => 'LMS password updated successfully.'], 200);
            } else {
                return response()->json(['error' => 'Failed to update LMS password.'], 500);
            }
        } catch (\Exception $e) {
            // Catch and return any exceptions
            return response()->json(['error' => 'An error occurred while updating LMS password.'], 500);
        }
    }

    function logout()
    {
        $user = MahasiswaDetail::where('t_mahasiswa_detail.mahasiswa_id', Session::get('mahasiswa_id'))->join('m_mahasiswa', 't_mahasiswa_detail.mahasiswa_id', '=', 'm_mahasiswa.id')->select('t_mahasiswa_detail.*', 'm_mahasiswa.nama')->orderBy('t_mahasiswa_detail.created_at', 'desc')->first();
        Session::getHandler()->destroy($user->session_id);
        $user->session_id = null;
        $user->save();
        Auth::guard('mahasiswa')->logout();

        return redirect()->route('login');
    }
}
