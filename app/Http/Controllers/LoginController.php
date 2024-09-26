<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\ShortenerURL;
use Illuminate\Http\Request;
use App\Models\MahasiswaDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    function index() {
        return view('login.index');
    }

    function generateLoginURL(Request $request) {
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

            $url  = 'http://192.168.110.96:80/login-process/' . $user->hp . '/' . $otp;
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

    function loginProcess($hp, $otp) {
        $user  = Mahasiswa::join('t_mahasiswa_detail', 't_mahasiswa_detail.mahasiswa_id', '=', 'm_mahasiswa.id')->where('t_mahasiswa_detail.hp', $hp)->select('t_mahasiswa_detail.*', 'm_mahasiswa.nama')->orderBy('t_mahasiswa_detail.created_at', 'desc')->first();

        $mahasiswa_detail = MahasiswaDetail::where('mahasiswa_id', $user->mahasiswa_id)->orderBy('created_at', 'desc')->first();

        if ($user->otp == $otp) {
            // nullify otp
            $mahasiswa_detail->otp = null;
            $mahasiswa_detail->save();

            // logout session lama
            $new_session_id = Session::getId();
            $last_session = Session::getHandler()->read($user->session_id);

            if ($last_session) {
                Session::getHandler()->destroy($user->session_id);
                Auth::guard('mahasiswa')->logout();
            }
            // login
            $mahasiswa_detail->session_id = $new_session_id;
            $mahasiswa_detail->save();

            Session::put('mahasiswa_id', $user->mahasiswa_id);
            Session::put('nama', $user->nama);
            Session::put('nim', $user->nim);
            Session::put('email', $user->email);

            Auth::guard('mahasiswa')->loginUsingId($user->mahasiswa_id);

            $user = Auth::guard('mahasiswa')->user();

            // return redirect()->route('dashboard');

            return redirect()->route('home');
        } else {
            $mahasiswa_detail->otp = null;
            $mahasiswa_detail->session_id = null;
            $mahasiswa_detail->save();

            return redirect()->route('login')->with('error', 'Ada kesalahan, silahkan coba lagi');
        }
    }

    function logout() {
        $user = MahasiswaDetail::where('t_mahasiswa_detail.mahasiswa_id', Session::get('mahasiswa_id'))->join('m_mahasiswa', 't_mahasiswa_detail.mahasiswa_id', '=' , 'm_mahasiswa.id')->select( 't_mahasiswa_detail.*' , 'm_mahasiswa.nama')->orderBy('t_mahasiswa_detail.created_at', 'desc')->first();
        Session::getHandler()->destroy($user->session_id);
        $user->session_id = null;
        $user->save();
        Auth::guard('mahasiswa')->logout();

        return redirect()->route('login');
    }
}
