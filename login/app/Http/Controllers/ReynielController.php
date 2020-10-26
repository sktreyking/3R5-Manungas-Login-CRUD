<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Response;
use Api\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
class ReynielController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  

    //

    public function page(){
        return view('login');
    }
    public function crud(){
            $id = app('db')->select("SELECT id FROM infos");
            $name = app('db')->select("SELECT name FROM infos");
            $age = app('db')->select("SELECT age FROM infos");
            $sex = app('db')->select("SELECT sex FROM infos");
            $address = app('db')->select("SELECT address FROM infos");
            $email = app('db')->select("SELECT email FROM infos");
            $phone = app('db')->select("SELECT phone FROM infos");
            

            $data = [
                'id'=>$id,
                'name'=>$name,
                'age'=>$age,
                'sex'=>$sex,
                'address'=>$address,
                'email'=>$email,
                'phone'=>$phone
            ];
            return view('dashboard')->with($data);
    }

    public function verify(){

            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = app('db')->select("SELECT * FROM login WHERE username='$username'");
            $pass = app('db')->select("SELECT * FROM login WHERE password='$password'");

            if(empty($user)){
                return "<script>alert('Wrong Username') </script> ". redirect()->route('login');
            }
            elseif(empty($pass)){
                return "<script>alert('Wrong Password') </script> ". redirect()->route('login');
            }else{
                 return "<script>alert('Welcome $username') </script> ". redirect()->route('dashboard');
            }

    }

    public function addUser(){
       
        $name = $_POST['name'];
        $age = $_POST['age'];
        $sex = $_POST['sex'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        app('db')->table('infos')->insert(['name' => $name, 'age' => $age,'sex' => $sex,'address' => $address,'email' => $email,'phone' => $phone]);
        return redirect()->route('dashboard');
    }

    public function editUser(){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $sex = $_POST['sex'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        
       app('db')->table('infos')->where('id', $id)->update(['name' => $name, 'age' => $age,'sex' => $sex,'address' => $address,'email' => $email, 'phone' => $phone]);
       return redirect()->route('dashboard');
    }

    public function deleteUser(){
            $id = $_POST['delete-Id'];

            app('db')->table('infos')->where('id', $id)->delete();
            return redirect()->route('dashboard');
    }
}
