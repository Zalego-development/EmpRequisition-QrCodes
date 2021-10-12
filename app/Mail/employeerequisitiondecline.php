<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
use DB;
class employeerequisitiondecline extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $void
     */
    public function build()
    {       

        $user =Auth::user()->name;
        $userid=Auth::user()->id;
        $usercompany_id=Auth::user()->company_id;
        $company=DB::table('companies')
                ->where('id', $usercompany_id)
                ->first();
                //dd($company);
         $getrole=DB::table('employeerequisitionusers')
                ->where('userId', $userid)
                ->first(); 
                // dd($getrole);      
         return $this->subject('Employee Requestion For '. " ". $this->data['jobtittle'] ." "." ". $company->company  ." " ." ".$getrole->employeetype)
            ->view('emails.employeerequisitiondecline');
    }
}
