<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class hrapprovingtoexecnotifyemail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
             $companyofrec=DB::table('users')
                      ->where('id', $this->data['rec'])
                      ->first();

        $usercompany_id=$companyofrec->company_id;
        $company=DB::table('companies')
                ->where('id', $usercompany_id)
                ->first();
                //dd($company);
 return $this->subject('Employee Requestion For'." "." ". $this->data['jobtittle'] ." ::". " "." ".$company->company)
            ->view('emails.hiringapprovingtohr');
    }
}
