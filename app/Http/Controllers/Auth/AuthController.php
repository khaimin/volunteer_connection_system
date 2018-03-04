<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\DVTN;
use App\TV;
use Illuminate\Http\Request;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/register';
    protected $redirectDVTN = '/abcd';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $a =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'rule' => $data['rule'],
            'password' => bcrypt($data['password']),
        ]);
        if ($a && $data['rule']==2) 
        {
            $id = User::select('id')->orderBy('id', 'DESC')->first();
            $longdv = $data['longdv'];
            $ladv = $data['ladv'];
            $dvtn = new DVTN;
            $dvtn->IDDV = $data['iddv'];
            $dvtn->TenDV = $data['tendv'];
            $dvtn->LongitudeDV = $longdv;
            $dvtn->LatitudeDV = $ladv;
            $dvtn->DVHDDV = $data['dvhd'];
            $dvtn->SDTDV = $data['sdt'];
            $dvtn->AvatarDV = "";
            
            

            // $file_name  = $data->file('avatar')->getClientOriginalName();
            // $dvtn->AvatarDV      = $file_name;
            // $request->file('avatar')->move('resources/upload/dvtn/avatar',$file_name);


            $dvtn->idDVTN = $id->id;
            $dvtn->ThongtinDV = $data['ttdv'];
            $dvtn->save();
            return $a;
            
        }
        else
        {
           $id = User::select('id')->orderBy('id', 'DESC')->first();
            $longdv = $data['longdv'];
            $ladv = $data['ladv'];
            $dvtn = new TV;
            $dvtn->IDTV = $data['iddvtv'];
            $dvtn->Ten = $data['tentv'];
            $dvtn->Longitude = $longdv;
            $dvtn->Latitude = $ladv;
            $dvtn->DVHD = $data['dvhdtv'];
            $dvtn->SĐT = $data['sdttv'];
            $dvtn->Avatar = "";

            // $file_name  = $data->file('avatartv')->getClientOriginalName();
            // $dvtn->Avatar     = $file_name;
            // $request->file('avatartv')->move('resources/upload/tv/avatar',$file_name);


            $dvtn->idUser = $id->id;
            $dvtn->Thongtin = $data['ttdvtv'];
            $dvtn->Status =1;
            $dvtn->save();
            return $a;
        }

        return $a;
    }

}
