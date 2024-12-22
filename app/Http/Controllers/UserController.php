<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function destroy(Request $request)
    {
        // Log out the authenticated user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token to prevent session fixation attacks
        $request->session()->regenerateToken();

        // Redirect to the login page (or any desired page)
        return redirect('/login')->with('success', 'You have successfully logged out.');
    }
    public function showDonations()
    {
        $donations = Donation::doesntHave('event')->get();

        $donations = Donation::all();
        $partners = User::where('role', 'partner')->get(); // Assuming `role` differentiates user types

    return view('admin.donations', compact('donations', 'partners'));
    }
    public function createEvent(Request $request)
    {
        $request->validate([
            'donation_id' => [
                'required',
                'exists:donations,id',
                function ($attribute, $value, $fail) {
                    // Check if a donation already has an associated event
                    if (Event::where('donation_id', $value)->exists()) {
                        $fail('An event has already been created for this donation.');
                    }
                },
            ],
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date|after_or_equal:today',
            'location' => 'required|string|max:255',
        ], [
            'donation_id.required' => 'Donation ID is required.',
            'donation_id.exists' => 'The selected donation does not exist.',
            'title.required' => 'The event title is required.',
            'date.after_or_equal' => 'The event date cannot be in the past.',
        ]);
    
        try {
            Event::create([
                'admin_id' => Auth::id(),
                'donation_id' => $request->donation_id,
                'title' => $request->title,
                'description' => $request->description,
                'date' => $request->date,
                'location' => $request->location,
            ]);
    
            return redirect()->route('home.view')->with('success', 'Event created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.donations')->with('error', 'An error occurred while creating the event. Please try again.');
        }
    }
    public function loginForm(){
        return view('login');
    }
    public function registerForm(){
        return view('register');
    }
    public function registerAsPartnerForm(){
        return view('registerAsPartner');
    }
    public function showRegistrationForm()
    {
        return view('admin.adminRegister'); // Ensure this matches your Blade file path
    }
    public function registerAdmin(Request $request)
    {
        // Validation rules
        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',  // Ensure password confirmation
            'phoneNo' => 'required|string|min:10|max:15',
        ]);

        // Create the admin
        User::create([
            'name' =>  $validatedData['name'],
            'email' =>  $validatedData['email'],
            'password' => Hash::make($request->password),
            'phoneNo' => $validatedData['phoneNo'],
            'role' => 'Admin', // Assuming a "role" field is used for user roles
        ]);

        return redirect('login')->with('success', 'Admin registered successfully!');
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]); 

        // Attempt to authenticate
        if (Auth::attempt($credentials)) {
            // Authentication passed
            $user = Auth::user();
            if ($user->role === 'Admin') {
                return redirect()->route('admin.donations')->with('success', 'Welcome Admin!');
            } else{
                return redirect()->route('home.view')->with('success', 'Welcome Partner!');
            } 
            // return redirect('')->with('success');
        }else {
            return redirect('login')->withErrors('Username dan Password yang dimasukan tidak valid');
        }
    }
    public function register(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',  // Ensure password confirmation
            'phoneNo' => 'required|string|min:10|max:15',  // Example of adding phone field
        ]);

        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // Hash the password
            'phoneNo' => $validatedData['phoneNo'], // Save the phone number
        ]);
        
        if (Auth::attempt($validatedData)) {
            // Authentication passed
            $user = Auth::user();
            return redirect('login')->with('success');
        }else {
            return redirect('login')->withErrors('Username dan Password yang dimasukan tidak valid');
        }

        
    }
    public function registerAsPartner(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',  // Ensure password confirmation
            'phoneNo' => 'required|string|min:10|max:15',  // Example of adding phone field
        ]);

        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // Hash the password
            'phoneNo' => $validatedData['phoneNo'], // Save the phone number
            'role' => 'Partner'
        ]);
        
        if (Auth::attempt($validatedData)) {
            // Authentication passed
            $user = Auth::user();
            return redirect('login')->with('success');
        }else {
            return redirect('login')->withErrors('Username dan Password yang dimasukan tidak valid');
        }

        
    }
    public function showDonation(){
         // Get the authenticated partner's donations
    $donations = Donation::with(['event', 'foodItems', 'donationProcesses'])
    ->where('user_id', Auth::id()) // Assuming 'user_id' is the partner's ID
    ->get();
        return view('partner.partner' , compact('donations'));
    }
    public function homepage(){
        return view('home');
    }
    public function updateDonationStatus(Request $request, Donation $donation)
{
    // Validate the incoming request
    $request->validate([
        'status' => 'required|in:pending,approved,completed,rejected',
    ]);

    // Update the status
    $donation->status = $request->status;
    $donation->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Donation status updated successfully.');
}

}
