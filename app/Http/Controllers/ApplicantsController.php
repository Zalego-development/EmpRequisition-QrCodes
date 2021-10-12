<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apllicant;
use RealRashid\SweetAlert\Facades\Alert;

class ApplicantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applicants = Apllicant::all();
        return view('applicants.index',compact('applicants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function employeerequisitionmail(Apllicant $applicant)
    {
    \Mail::to('felixmerriapie@gmail.com')->send(new \App\Mail\employeerequisitionmail($applicant));

    Alert::success('Success','You have successfully sent an Email ');
    return back();
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apllicant $applicant)
    {
        return view('applicants.show', compact('applicant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apllicant $applicant)
    {
    $applicant = Apllicant::findOrFail($applicant);
  dd($applicant);
    $this->validate($request, [
        'action' => 'required',
    ]);

    $input = $request->all();

    $applicant->fill($input)->save();

    Session::flash('flash_message', 'Task successfully added!');

    return redirect()->back();;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
