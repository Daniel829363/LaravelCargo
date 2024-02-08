<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Hash;
class UserController extends Controller
{
   public function index()
    {
        $users = User::get();

        return view('admin.users', ['users'=>$users]);
    }

    public function createView()
    {
        return view('admin.userCreate');
    }

    public function editUser (User $user){
        return view('admin.editUsers',[
            'user'=>$user]);
    }

    public function employeeindex()
    {
        $users = User::where('role','client')->get();

        return view('employee.users', ['users'=>$users]);
    }

    public function employeecreateView()
    {
        return view('employee.userCreate');
    }

    public function employeeeditUser (User $user){
        return view('employee.editUsers',[
            'user'=>$user]);
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request)
    {
        $request->validate([
        'file' => 'required|mimes:csv,xls,xlsx',
    ]);

    if ($request->hasFile('file')) {
        Excel::import(new UsersImport, $request->file('file'));
        return back()->with('success', 'Users imported successfully.');
    } else {
        return back()->withErrors(['file' => 'Please choose a file to import.']);
    }
    }

public function create(Request $request)
{
    try {
    $user = new User;
  $user->name = $request->name;
  $user->number = $request->number;
  $user->email = $request->email;
  $user->code = $request->code;
  $user->role = $request->role;
  if (empty($request->password)){
  $user->password = Hash::make($request->code);}
else{
  $user->password = Hash::make($request->password);
}
  $user->save();
  return redirect()->route('admin.users')->with('success', 'Успешно добавлена.');
  } catch (\Exception $e) {

        return redirect()->route('admin.users')->with('error', 'Ошибка при добавлении пользователя.');
    }
}
public function employeecreate(Request $request)
{
    try {
    $user = new User;
  $user->name = $request->name;
  $user->number = $request->number;
  $user->email = $request->email;
  $user->code = $request->code;
  if (empty($request->password)){
  $user->password = Hash::make($request->code);}
else{
  $user->password = Hash::make($request->password);
}
  $user->save();
  return redirect()->route('employee.users')->with('success', 'Успешно добавлена.');
  } catch (\Exception $e) {

        return redirect()->route('employee.users')->with('error', 'Ошибка при добавлении пользователя.');
    }
}
public function update(Request $request, User $user)
{
    /*$request->validate([
        'role' => 'required|in:client,employee,admin',
    ]);*/

  $user->update(['name' => $request->name]);
  $user->update(['number' => $request->number]);
  $user->update(['email' => $request->email]);
  $user->update(['code' => $request->code]);
  $user->update(['role' => $request->role]);
  if ($request->password!=null){
  $user->update(['password' => $request->password]);
}
    return redirect()->route('admin.users')->with('success', 'успешно обновлена.');

}

public function filter(Request $request)
{
    $query = User::query();

    // Применяем фильтры, если они были предоставлены в запросе
    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->input('name') . '%');
    }

    if ($request->filled('email')) {
        $query->where('email', 'like', '%' . $request->input('email') . '%');
    }

    if ($request->filled('number')) {
        $query->where('number', 'like', '%' . $request->input('number') . '%');
    }

    if ($request->filled('code')) {
        $query->where('code', 'like', '%' . $request->input('code') . '%');
    }

    if ($request->filled('role')) {
        $query->where('role', $request->input('role'));
    }

    // Получаем отфильтрованные данные
    $users = $query->get();

    return view('admin.users', compact('users'))->with('success', 'Успешно обновлено.');
}

public function employeeupdate(Request $request, User $user)
{

  $user->update(['name' => $request->name]);
  $user->update(['number' => $request->number]);
  $user->update(['email' => $request->email]);
  $user->update(['code' => $request->code]);
  if ($request->password!=null){
  $user->update(['password' => $request->password]);
}
    return redirect()->route('employee.users')->with('success', 'успешно обновлена.');

}

public function employeefilter(Request $request)
{
    $query = User::query();

    // Применяем фильтры, если они были предоставлены в запросе
    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->input('name') . '%');
    }

    if ($request->filled('email')) {
        $query->where('email', 'like', '%' . $request->input('email') . '%');
    }

    if ($request->filled('number')) {
        $query->where('number', 'like', '%' . $request->input('number') . '%');
    }

    if ($request->filled('code')) {
        $query->where('code', 'like', '%' . $request->input('code') . '%');
    }

    if ($request->filled('role')) {
        $query->where('role', 'client');
    }

    // Получаем отфильтрованные данные
    $users = $query->get();

    return view('employee.users', compact('users'))->with('success', 'Успешно обновлено.');
}



public function destroy(User $user){
    $user->delete();
    return redirect()->route('admin.users')->with('success', 'успешно обновлена.');
}
}
