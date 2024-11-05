<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Address;

class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $address = $user->address;

        return view('admin.pages.profile', compact('address'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(User $user)
    // {

    // }
    public function show(Request $request)
    {
        $user = Auth::user();
        $address = $user->address;

        return view('admin.pages.profile', [
            'request' => $request,
            'user' => $request->user(),
            'address' => $address,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($request['photo']);
        }

        if (
            $request['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $request);
        } else {
            $user->forceFill([
                'name' => $request['name'],
                'email' => $request['email'],
            ])->save();
        }

        // $validatedData = $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        //     'phone_number' => ['required', 'string', 'max:255', 'unique:users,phone_number,' . $user->id],
        //     'password' => ['nullable', 'string', Password::default(), 'confirmed'],
        //     'address' => 'required|string|max:255',
        //     'province' => 'required|string|max:255',
        //     'city' => 'required|string|max:255',
        //     'district' => 'required|string|max:255',
        //     'post_code' => 'required|string|max:20',
        //     'delivery_instructions' => 'nullable|string|max:500',
        // ]);

        // // Update user information
        // $user->update([
        //     'name' => $validatedData['name'],
        //     'username' => $validatedData['username'],
        //     'email' => $validatedData['email'],
        //     'phone_number' => $validatedData['phone_number'],
        //     'password' => $request->password ? Hash::make($validatedData['password']) : $user->password,
        // ]);

        // // Update or create address
        // $addressData = [
        //     'address' => $validatedData['address'],
        //     'province' => $validatedData['province'],
        //     'city' => $validatedData['city'],
        //     'district' => $validatedData['district'],
        //     'post_code' => $validatedData['post_code'],
        //     'delivery_instructions' => $validatedData['delivery_instructions'],
        // ];

        // if ($user->address) {
        //     $user->address->update($addressData);
        // } else {
        //     $user->address()->create($addressData);
        // }

        // return redirect()->route('customer.profile.index')->with('success', 'Profile updated successfully.');
    }

    /**
     * Update the verified user's information.
     */
    protected function updateVerifiedUser(User $user, Request $request)
    {
        $user->forceFill([
            'name' => $request['name'],
            'email' => $request['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
