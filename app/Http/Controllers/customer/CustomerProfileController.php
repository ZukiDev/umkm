<?php

namespace App\Http\Controllers\customer;

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

class CustomerProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $address = $user->address;

        return view('customer.pages.profile', compact('address'));
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

        return view('customer.pages.profile', [
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
    public function update(Request $request)
    {
        // dd($request);
        $user = Auth::user();
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255', 'unique:users,phone_number,' . $user->id],
            'address' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'post_code' => 'required|string|max:20',
            'delivery_instructions' => 'nullable|string|max:500',
        ]);

        // Update user information
        $userUpdate = User::where('id', $user->id);
        $userUpdate->update([
            'name' => $validatedData['name'],
            'phone_number' => $validatedData['phone_number'],
        ]);

        // Update or create address
        $addressData = [
            'address' => $validatedData['address'],
            'province' => $validatedData['province'],
            'city' => $validatedData['city'],
            'district' => $validatedData['district'],
            'post_code' => $validatedData['post_code'],
            'delivery_instructions' => $validatedData['delivery_instructions'] ?? 'Tidak ada',
        ];

        if ($user->address) {
            $user->address->update($addressData);
        } else {
            $user->address()->create($addressData);
        }

        return redirect()->route('customer.profile')->with('success', 'Profile updated successfully.');
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
