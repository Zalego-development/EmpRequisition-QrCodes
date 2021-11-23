<?php

namespace App\Observers;

class history_log
{
    //




    public function History_log(Request $request)
    {
        $email_address=$request->input('email_address');
        
        $action=$request->input('contactionact2');
        //$ip=$request->input('ip');
        $ip = $_SERVER["REMOTE_ADDR"];
        //$host=strtolower($request->input('host'));
        $host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $login_time=date('Y-m-d')." ".date('h:i:s A');

        $insert=DB::update('UPDATE lead_activities SET customer=?,activity_status=?,subject=?,description=?,time_set=?,date_set=?,created_at=?,updated_at=? WHERE activityId=?',[$customer,$channel,$title,$description,$time,$date,$created_at,$created_at,$id]);

        $insert=DB::insert('INSERT INTO history_log (customer,activity_status,subject,description,time_set,date_set,created_at,updated_at) VALUE(?,?,?,?,?,?,?,?)',[$customer,$channel,$title,$description,$time,$date,$created_at,$created_at]);
        mysqli_query($conn,"INSERT INTO history_log(id,email_address,action,ip,host,login_time) VALUES('0','$email_address','$remarks','$ip','$host','$date')")or die(mysqli_error($conn));
        $_SESSION['email_address'] = $email_address;
        
    }
}
