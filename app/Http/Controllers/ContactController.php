<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Role, Contact};

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $user = auth()->user();

        if ($user->isAdmin()) {
            // Option A: show only admin's own contacts here
            // $contacts = Contact::where('user_id', $user->id)->latest()->paginate(15);

            // Option B: show admin their own contacts but link to admin page for all
            $contacts = Contact::where('user_id', $user->id)->latest()->paginate(15);

            return view('contacts.index', compact('contacts'));
        }

        // Regular users: only their own contacts
        $contacts = $user->contacts()->latest()->paginate(15);
        return view('contacts.index', compact('contacts'));
    }

    public function allContacts()
    {
        // Shows ALL contacts across system (for admin)
        $contacts = Contact::with('user')->latest()->paginate(20);
        return view('admin.contacts_all', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate input
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:contacts,email',
            'phone'   => 'required|string|max:10',
            'address' => 'nullable|string',
        ]);

        $data['user_id'] = auth()->id();

        Contact::create($data);

        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            // allow same email for current contact
            'email'   => 'required|email|unique:contacts,email,' . $contact->id,
            'phone'   => 'required|string|max:50',
            'address' => 'nullable|string',
        ]);

        $contact->update($data);

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
