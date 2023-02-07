<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::whereHas('roles', function ($q) {
            $q->where('title', 'Company');
        })->orderBy('id', 'DESC')->get();
        
        return view('admin.company.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.create');
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
            'company_name' => 'required',
            'email' => 'required|unique:users,email|email',
            'designation' => 'required',
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
        $company = User::create([
            'name' => $request->company_name,
            'first_name' => $request->first_name,
            'maiden_name' => $request->maiden_name,
            'last_name' => $request->last_name,
            'designation' => $request->designation,
            'email' => $request->email,
            'password' => Hash::make($password),
        ] + ['image' => $image]);

        /** assign the role  */
        $company->roles()->sync(1);

        $message['email'] = $request->email;
        $message['password'] = $password;

        try {
            // Mail::to($request->email)->send(new UserLoginPassword($message));
            return redirect()->route('company.index')->with(['status' => true, 'message' => 'Company Created sucessfully']);
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
        return view('admin.company.edit', compact('data'));
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
        // return $request;
        $request->validate([
            'company_name' => 'required',
            'email' => 'required',
            'designation' => 'required',
        ]);

        $company = User::find($id);
        if ($request->hasfile('image')) {
            $destination = 'public/admin/assets/images/users' . $company->image;
            if (File::exists($destination) || File::exists($company->image)) {
                File::delete($destination);
                File::delete($company->image);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/admin/assets/images/users', $filename);
            $image = 'public/admin/assets/images/users/' . $filename;
        } else {
            $image = $company->image;
        }

        $company->update([
            'name' => $request->company_name,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'maiden_name' => $request->maiden_name,
            'last_name' => $request->last_name,
            'designation' => $request->designation,
        ] + ['image' => $image]);

        return redirect()->route('company.index')->with(['status' => true, 'message' => 'Company Updated sucessfully']);
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
        return redirect()->back()->with(['status' => true, 'message' => 'Company Deleted sucessfully']);
    }

    public function status($id)
    {
        $data = User::find($id);
        $data->update(['is_active' => $data->is_active == 0 ? '1' : '0']);
        return redirect()->back()->with(['status' => true, 'message' => 'Status Updated sucessfully']);
    }
}
