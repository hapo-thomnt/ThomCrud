<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\UpdateContactRequest;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();
        $data = [
            'contacts' => $contacts,
        ];
        return view('contacts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateContactRequest $request)
    {
        $input = $request->except('avatar');
        $contact = $request->all();
        if($request->hasFile('avatar')){
            $storagePath= Storage::putFile ('public/avatar/', $request->file('avatar'));
            $input['avatar']  = basename($storagePath);
        }
        $user = Contact::create($input);

        return redirect()->route('contacts.index')->with('success', __('messages.contact_create_success'));

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
        $contact = Contact::find($id);
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, $id)
    {
        $imageName = $request->file('avatar')->getClientOriginalExtension();
        $imageName = time().'_'.$imageName ;
        Storage::putFileAs ('avatar', $request->file('avatar'),$imageName);

        $contact = Contact::findOrFail($id);
        $input = $request->except('avatar');

        if($request->hasFile('avatar')){
            $storagePath= Storage::putFile ('public/avatar/', $request->file('avatar'));
            $imageName = basename($storagePath);
            $input['avatar'] = $imageName;
        }

        $contact->update($input);

        return redirect()->route('contacts.index')->with('success', __('messages.contact_update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        if($contact){
            $destroy = Contact::destroy($id);
        }
        //TODO
        return redirect('/contacts')->with('success', 'Contact deleted!');
    }
}
