<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use App\Http\Requests\loginrequest;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{

    public function getlogin()
    {
     return view('admin.admin_login');
    }

    public function postlogin(loginrequest $request)
    {

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"),
         'password' => $request->input("password")])) {
            return redirect()->route('admin.dashboard');

        }
        if (auth()->user()->type=='company' &&  auth()->attempt(['email' => $request->input("email"),
                'password' => $request->input("password")])){


         return redirect()->route('company.dashboard');

        }else{
            return redirect()->back()->with(['error'=>'المعلومات خاطئة']);

        }
    }

    public function logout()
    {

        $gaurd = $this->getGaurd();
        $gaurd->logout();

        return redirect()->route('login');
    }

    private function getGaurd()
    {
        return auth('admin');
    }

    public function index(){

         $users = User::where('name','!=','admin')->get();

        return view('dashboard',compact('users'));


    }
    public function store(){




    }



}
