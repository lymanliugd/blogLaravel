<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    private function verifyCode($inputCode){

        try{
            $code = new \Code();
            if(strtoupper($inputCode) != $code->get()){
                return FALSE;
            }
            return TRUE;
        }
        catch (\Exception $exception){
            echo 'verifyCode error';
            return FALSE;
        }
    }

    private function verifyUser($inputUser){

        try{
            $user = User::first();
            if($user->user_name != $inputUser['user_name'] &&
                Crypt::decrypt($user->user_psw) != $inputUser['user_psw']){
                return FALSE;
            }
            session(['user'=>$user]);
            return TRUE;
        }
        catch (\Exception $exception){
            echo 'verifyUser error';
            return FALSE;
        }

    }

    public function login(){

        if($input = Input::all()) {

           if(!$this->verifyCode($input['code'])){
               return back()->with('msg','验证码错误！');
           }
           if(!$this->verifyUser($input)){
               return back()->with('msg','用户名或者密码错误！');
           }
            return redirect('admin/index');
        }
        else {
            session(['user'=>null]);
            return view('Admin.login');
        }
    }

    public function quit(){
        session(['user'=>null]);
        return redirect('admin/login');
    }

    public function code(){
        try{
            $code = new \Code();
            $code->make();
            return $code->get();
        }
        catch (\Exception $exception){
            echo 'create code error';
        }
    }

    //for test
    public function crypt(){

        $str = '111';
        return Crypt::encrypt($str);
    }
}
