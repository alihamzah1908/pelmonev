<?php

namespace App\Http\Controllers\Auth;

use DB;
use App\Models\AuthUser;
use App\Models\AuthRoleUser;
use App\Models\PublicTrxPemohon;
use Illuminate\Auth\Events\Registered;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();


        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        return $this->registered($request, $user) ?: redirect($this->redirectPath())->with('success', 'Pendaftaran Berhasil. Silakan cek Email atau Spam untuk melihat tanda bukti pendaftaran');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'      => ['required', 'string', 'max:255'],
            'phone'     => ['required', 'string', 'max:20'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:pgsql.auth.users'],
            'password'  => ['required', 'string', 'min:6', 'max:12', 'confirmed', 'regex:/[A-Z]/', 'regex:/[a-z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
            'nik'     => ['required', 'string', 'max:32'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\AuthUser
     */
    protected function create(array $data){
        try {
            DB::BeginTransaction();
            $pemohon                = new PublicTrxPemohon();
            $pemohon->pemohon_nm    = $data['name'];
            $pemohon->phone         = $data['phone'];
            $pemohon->created_by    = $data['name'];
            $pemohon->save();

            $user             = new AuthUser();
            $user->user_id    = $pemohon->trx_pemohon_id;
            $user->user_nm    = $data['name'];
            $user->email      = $data['email'];
            $user->phone      = $data['phone'];
		    $user->rule_tp    = '1111';
            $user->default_key= $pemohon->trx_pemohon_id;
		    $user->password   = Hash::make($data['password']);
            $user->created_by = $data['name'];
            $user->nik = $data['nik'];
            $user->save();

            $roleUser          = new AuthRoleUser();
            $roleUser->user_id = $user->user_id;
            $roleUser->role_cd = 'pemohon';
            $roleUser->save();
            DB::commit();

		    return $user;
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
