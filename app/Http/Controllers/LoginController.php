<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
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
        $user = Mahasiswa::join('t_mahasiswa_detail', 't_mahasiswa_detail.mahasiswa_id', '=', 'm_mahasiswa.id')
            ->where('t_mahasiswa_detail.hp', $hp)
            ->select('t_mahasiswa_detail.*', 'm_mahasiswa.*')
            ->orderBy('t_mahasiswa_detail.created_at', 'desc')
            ->first();

        $mahasiswa_detail = MahasiswaDetail::where('mahasiswa_id', $user->mahasiswa_id)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($user->otp == $otp) {
            // 1. Generate random string untuk password LMS
            $passwordLMS = Str::random(8); // Panjang password 8 karakter, bisa disesuaikan
            $user->password_lms = bcrypt($passwordLMS); // Simpan dalam bentuk hash jika diperlukan
            $user->save();

            // Store LMS credentials in session
            session([
                'update_lms_password' => true,
                'lms_credentials' => [
                    'username' => $user->nim,
                    'password' => $passwordLMS,
                ]
            ]);

            // Lanjutkan proses login seperti biasa
            $mahasiswa_detail->otp = null;
            $mahasiswa_detail->save();

            $new_session_id = Session::getId();
            $last_session = Session::getHandler()->read($user->session_id);

            if ($last_session) {
                Session::getHandler()->destroy($user->session_id);
                Auth::guard('mahasiswa')->logout();
            }

            $mahasiswa_detail->session_id = $new_session_id;
            $mahasiswa_detail->save();

            Session::put('mahasiswa_id', $user->mahasiswa_id);
            Session::put('nama', $user->nama);
            Session::put('nim', $user->nim);
            Session::put('email', $user->email);

            $mahasiswaKtm = \App\Models\MahasiswaKtm::where('mahasiswa_id', $user->mahasiswa_id)
                ->where('status', 2)
                ->first();

            if ($mahasiswaKtm) {
                Session::put('ktm_path', $mahasiswaKtm->path_photo);
            } else {
                Session::put('ktm_path', null);
            }

            Auth::guard('mahasiswa')->loginUsingId($user->mahasiswa_id);

            return redirect()->route('home');
        } else {
            $mahasiswa_detail->otp = null;
            $mahasiswa_detail->session_id = null;
            $mahasiswa_detail->save();

            return redirect()->route('login')->with('error', 'Ada kesalahan, silahkan coba lagi');
        }
    }

    public function clearLmsPasswordSession()
    {
        session()->forget('update_lms_password');
        return response()->json(['status' => 'session cleared']);
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
