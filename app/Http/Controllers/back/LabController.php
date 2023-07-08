<?php

namespace App\Http\Controllers\back;


use App\Http\Controllers\Controller;
use App\Models\Lab;
use App\Models\Patient;
use App\Models\ChMessage;
use App\Models\User;
use Illuminate\Http\Request;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    public function analysis()
    {
        $lab = Lab::all();
        $lab2 = Lab::all();
        return view('admin.lab.lab' , compact('lab','lab2'));
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
        Lab::create([
            'patient_id' => $request->patient_id,
            'type' => $request->type,
        ]);
        return back()->with("success", " Lab updated Successfully ");
    }

    public function store2(Request $request)
    {
        Lab::create([
            'patient_id' => $request->patient_id,
            'type' => $request->type,
            'department_name' => $request->department_name,
            'doctor_name' =>$request->doctor_name,
        ]);
        return back()->with("success", " Lab updated Successfully ");
    }

    public function storeAttachment(Request $request , $id)
    {
        $attach = Lab::where('patient_id', $id)->firstOrFail();

        // Check if attachment file is present in the request
        if ($request->hasFile('attachements')) {
            $destination_path = 'images';
            $attachements = $request->file('attachements');
            $attachement_name = $attachements->getClientOriginalName();
            // $path = $attachements->storeAs($destination_path, $attachement_name);
            $attachements->move(('storage/images'), $attachement_name);

            $attach->attachements= $attachement_name;
            // $attach->attachements = 'storage/images/'.$attachement_name; // Update the file path

        }
        $attach->status = 'finished';
        $attach->save();

        session()->flash('success', 'Attachment added successfully');
        return redirect()->back();

    }


    public function fetchName($id)
    {
        $patient = Patient::findorFail($id);
        return $patient->name;

    }
    /**
     * Display the specified resource.
     */
    public function show(Lab $lab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lab $lab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lab $lab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lab $lab)
    {
        //
    }

    public function MarkAsRead_all(Request $request)
    {
        $user = auth()->user();
        $messages = ChMessage::where('to_id', $user->id)->where('seen', 0)->get();

        foreach ($messages as $message) {
            $message->update(['seen' => 1]);
        }

        return back();
    }


}
