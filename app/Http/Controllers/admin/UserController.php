<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Hash;

class UserController extends Controller
{
    	public function index(Request $request) {
		if (!auth()->user()->can('user.view')) {
			abort(403, 'Unauthorized action.');
		}
		return view('admin.user.index');
	}


	public function datatable(Request $request)
	{
		if (request()->ajax()) {
			$users = User::all()->except(1);
			return Datatables::of($users)
				->addIndexColumn()
				->addColumn('action', function ($model) {
					return view('admin.user.action', compact('model'));
				})
				->addColumn('role', function ($model) {
					return $role_name = getUserRoleName($model->id);
				})
				->editColumn('status', function ($model) {

					return view('admin.status', compact('model'));
				})
				->rawColumns(['action', 'status'])->make(true);

		}
	}

		public function create(Request $request) {
		if (!auth()->user()->can('user.create')) {
			abort(403, 'Unauthorized action.');
		}

		if ($request->isMethod('get')) {
			$roles = Role::where('name', '!=', config('system.default_role.admin'))->get()->pluck('name', 'id')->prepend('Select Role...', '');
			return view('admin.user.create', compact('roles'));
		} else {
			$validator = $request->validate([
				'surname' => 'required', 'max:255',
				'first_name' => 'required', 'max:255',
				'last_name' => 'required', 'max:255',
				'username' => ['required', 'string', 'max:255', 'unique:users'],
				'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
				'password' => ['required', 'string', 'min:8', 'confirmed'],
			]);

			$user = new User;
			$user->surname = $request->surname;
			$user->first_name = $request->first_name;
			$user->last_name = $request->last_name;
			$user->username = $request->username;
			$user->email = $request->email;
			$user->username = $request->username;
			$user->password = Hash::make($request->password);
			$user->status = 'activated';
			$user->save();

			$role_id = $request->input('role');
			$role = Role::findOrFail($role_id);
			$user->assignRole($role->name);

			return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('User Created'), 'goto' => route('admin.user.index')]);
		}
	}

	public function status(Request $request, $value, $id) {
		if (!auth()->user()->can('user.update')) {
			abort(403, 'Unauthorized action.');
		}

		if (request()->ajax()) {
			$user = User::find($id);
			$user->status = $value;
			$user->save();

			return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Status Updated')]);
		}
	}

  public function edit($id) {
		if (!auth()->user()->can('user.update')) {
			abort(403, 'Unauthorized action.');
		}
		$user = User::find($id);
		$roles = Role::where('name', '!=', config('system.default_role.admin'))->get()->pluck('name', 'id')->prepend('Select Role...', '');
		return view('admin.user.edit', compact('user', 'roles'));
	}

	public function update(Request $request) {
		if (!auth()->user()->can('user.update')) {
			abort(403, 'Unauthorized action.');
		}

		if (request()->ajax()) {
			$id = $request->id;
			$user = User::findOrFail($id);
			$validator = $request->validate([

				'surname' => ['required', 'max:255'],
				'first_name' => ['required', 'max:255'],
				'last_name' => ['required', 'max:255'],
				'username' => ['required', 'string', 'max:255',
					Rule::unique('users', 'username')->ignore($user->id)],
				'email' => ['required', 'string', 'email', 'max:255',
					Rule::unique('users', 'email')->ignore($user->id)],

			]);

			$user->surname = $request->surname;
			$user->first_name = $request->first_name;
			$user->last_name = $request->last_name;
			$user->username = $request->username;
			$user->email = $request->email;
			$user->username = $request->username;
			$user->password = Hash::make($request->password);
			$user->status = 'activated';

			$role_id = $request->input('role');
			$user_role = $user->roles->first();

			if ($user_role->id != $role_id) {
				$user->removeRole($user_role->name);

				$role = Role::findOrFail($role_id);
				$user->assignRole($role->name);
			}

			return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('User Updated'), 'goto' => route('admin.user.index')]);

		}
	}

	public function destroy(Request $request, $id) {
		if (!auth()->user()->can('user.delete')) {
			abort(403, 'Unauthorized action.');
		}

		if (request()->ajax()) {

			$user = User::find($id);
			$user->delete();
			return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('User Deleted')]);
		}
	}
}
