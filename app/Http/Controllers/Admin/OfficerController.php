<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\storage;

class OfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::whereHas('roles', function ($q) {
            $q->where('title', 'Officer');
        })->orderBy('id', 'DESC')->get();
        return view('admin.officer.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.officer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email|email',
            'image' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('admin/assets/images/users/'), $filename);
            $image = 'public/admin/assets/images/users/' . $filename;
        } else {
            $image = 'public/admin/assets/images/users/1675332882.jpg';
        }

        /**generate random password */
        $password = random_int(10000000, 99999999);

        $officer = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
        ] + ['image' => $image]);

        /** assign the role  */
        $officer->roles()->sync(2);

        $message['email'] = $request->email;
        $message['password'] = $password;

        try {
            // Mail::to($request->email)->send(new UserLoginPassword($message));
            return redirect()->route('officer.index')->with(['status' => true, 'message' => 'Officer Created sucessfully']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return back()
                ->with(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        return view('admin.officer.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $officer = User::find($id);
        if ($request->hasfile('image')) {
            $destination = 'public/admin/assets/images/users' . $officer->image;
            if (File::exists($destination) || File::exists($officer->image)) {
                File::delete($destination);
                File::delete($officer->image);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/admin/assets/images/users', $filename);
            $image = 'public/admin/assets/images/users/' . $filename;
        } else {
            $image = $officer->image;
        }

        $officer->update([
            'name' => $request->name,
        ] + ['image' => $image]);

        return redirect()->route('officer.index')->with(['status' => true, 'message' => 'Officer Updated sucessfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with(['status' => true, 'message' => 'Officer Deleted sucessfully']);
    }

    public function status($id)
    {
        $data = User::find($id);
        $data->update(['is_active' => $data->is_active == 0 ? '1' : '0']);
        return redirect()->back()->with(['status' => true, 'message' => 'Status Updated sucessfully']);
    }
}
