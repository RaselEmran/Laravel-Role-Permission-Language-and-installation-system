<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\User;
use Validator;
use Illuminate\Validation\Rule;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UiController extends Controller
{
   public function index()
   {
   	$id =Auth::user()->id;
   	$user =User::findOrFail($id);
    return view('admin.user.profile',compact('user'));
   }

      public function postprofile(Request $request)
   {
   	  if ($request->ajax()) {
			$validator = Validator::make($request->all(),[
				'first_name' => ['sometimes', 'nullable','string'],
				'last_name' => ['sometimes', 'nullable','string'],
			]);
			$id =Auth::user()->id;
        	$model =User::findOrFail($id);
			$model->surname =$request->surname;
			$model->first_name =$request->first_name;
			$model->last_name =$request->last_name;
			$model->name =$request->name;
			$model->phone =$request->phone;
			$model->save();
			return response()->json(['message' => _lang('Profile Update.')]);
		}
   }

public function password_change(Request $request)
   {
   if ($request->ajax()) {
			$validator = $request->validate([
		     'password' => ['required', 'string', 'min:6', 'confirmed'],
			]);

			$id =Auth::user()->id;
        	$model =User::findOrFail($id);
        	$model->password=Hash::make($request->password);
        	$model->save();
        	return response()->json(['message' => _lang('Password Change.')]);
		}
	}
}
