<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
class ImapController extends Controller
{
private $subject="";
   public function retrieveImapMails(){
        //imap class
 //imap class
error_reporting(0);
//$email=new Imap();
$inbox=null;
if($this->connect(
    '{mail.zalegoinstitute.ac.ke:993}INBOX',//host
    'brian@zalegoinstitute.ac.ke' ,//username
    '#.~^}PFznp?x' //password
    // '{imap.gmail.com:993/imap/ssl}INBOX',//host
    // 'Grace@atarahsolutions.co.ke' ,//username
    // 'neema#jay12345' //password
)){
    //inbox array
    $inbox=$this->getMessages('html');
}

//allow utf entry
DB::insert('ALTER TABLE hrmis_mails MODIFY COLUMN senderMessage LONGTEXT
    CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL');
DB::insert('ALTER TABLE hrmis_mails MODIFY COLUMN senderDate VARCHAR(291)
    CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL');
if($inbox==null){
            $success=3;
            return response()->json(array('success'=>$success),200);
        }else{
            foreach($inbox["data"] as $v){

            	//check if there is duplication
 //$connect=mysqli_connect("localhost","root","","hr");
            	//$deleteDuplicates=mysqli_query($connect,'DELETE n1 FROM hrmis_mails n1, hrmis_mails n2 WHERE n1.mailId>n2.mailId  AND n1.senderName=n2.senderName AND n1.senderMessage=n2.senderMessage AND n1.senderAddress=n2.senderAddress');
            				$countAttachment=0;
                            $attachment='';
                            if(!empty($v['attachments'])){
                                foreach($v['attachments'] as $a){
                                    $countAttachment+=1;
                                }
                            } 
                            $mailId=DB::table('hrmis_mails')->insertGetId([
                                'senderMail'=>$v['from']['address'],
                                'senderName'=>(empty($v['from']['name']) ? '{empty}' : $v['from']['name']),
                                'attachmentCount'=>$countAttachment,
                                'senderDate'=>$v['date'],
                                'senderSubject'=>$v['subject'],
                                'senderAddress'=>$v['from']['address'],
                                'senderMessage'=>$v['message'].(!empty($attachment) ? '<hr>Attachments:'.$attachment : '')
                            ]);

                            //save attachments
                            if(!empty($v['attachments'])){
                                foreach($v['attachments'] as $a){
                                    $attachment=$a["file"];
                                    DB::table('mailattachments')->insertGetId([
                                        'comId'=>$mailId,
                                        'docLink'=>$attachment
                                    ]);
                                }
                            }


                        }

                        $success=1;
                        return response()->json(array('success'=>$success),200);
        
    }
    }


    public function connect($hostname, $username, $password) {
        $connection = imap_open($hostname, $username, $password) or die('Cannot connect to Mail: ' . imap_last_error());
        if (!preg_match("/Resource.id.*/", (string) $connection)) {
            return $connection; //return error message
        }
        $this->imapStream = $connection;
        return true;
    }
    public function getMessages($type = 'text') {
        $this->attachments_dir = rtrim($this->attachments_dir, '/');
        $stream = $this->imapStream;
        $emails = imap_search($stream, 'ALL');
        $messages = array();
        if ($emails) {
            $this->emails = $emails;
            foreach ($emails as $email_number) {
                $this->attachments = array();
                $uid = imap_uid($stream, $email_number);
                $messages[] = $this->loadMessage($uid, $type);
            }
        }
        return array(
            "status" => "success",
            "data" => array_reverse($messages)
        );
    }
    public function getFiles($r) { //save attachments to directory
        $pullPath = $this->attachments_dir . '/' . $r['file'];
        $res = true;
        if (file_exists($pullPath)) {
            $res = false;
        } elseif (!is_dir($this->attachments_dir)) {
            $this->errors[] = 'Cant find directory for email attachments! Message ID:' . $r['uid'];
            return false;
        } elseif (!is_writable($this->attachments_dir)) {
            $this->errors[] = 'Attachments directory is not writable! Message ID:' . $r['uid'];
            return false;
        }
        if($res && !preg_match('/\.php/i', $r['file']) && !preg_match('/\.cgi/i', $r['file']) && !preg_match('/\.exe/i', $r['file']) && !preg_match('/\.dll/i', $r['file']) && !preg_match('/\.mobileconfig/i', $r['file'])){
            if (($filePointer = fopen($pullPath, 'w')) == false) {
                $this->errors[] = 'Cant open file at imap class to save attachment file! Message ID:' . $r['uid'];
                return false;
            }
            switch ($r['encoding']) {
                case 3: //base64
                    $streamFilter = stream_filter_append($filePointer, 'convert.base64-decode', STREAM_FILTER_WRITE);
                    break;
                case 4: //quoted-printable
                    $streamFilter = stream_filter_append($filePointer, 'convert.quoted-printable-decode', STREAM_FILTER_WRITE);
                    break;
                default:
                    $streamFilter = null;
            }
            imap_savebody($this->imapStream, $filePointer, $r['uid'], $r['part'], FT_UID);
            if ($streamFilter) {
                stream_filter_remove($streamFilter);
            }
            fclose($filePointer);
            return array("status" => "success", "path" => $pullPath);
        }else{
            return array("status" => "success", "path" => $pullPath);
        }
    }
    private function loadMessage($uid, $type) {
        $overview = $this->getOverview($uid);
        $array = array();
        $array['uid'] = $overview->uid;
        $array['subject'] = isset($overview->subject) ? $this->decode($overview->subject) : '';
        $array['date'] = date('Y-m-d h:i:sa', strtotime($overview->date));
        $headers = $this->getHeaders($uid);
        $array['from'] = isset($headers->from) ? $this->processAddressObject($headers->from) : array('');
        $structure = $this->getStructure($uid);
        if (!isset($structure->parts)) { // not multipart
            $this->processStructure($uid, $structure);
        } else { // multipart
            foreach ($structure->parts as $id => $part) {
                $this->processStructure($uid, $part, $id + 1);
            }
        }
        $array['message'] = $type == 'text' ? $this->plaintextMessage : $this->htmlMessage;
        $array['attachments'] = $this->attachments;
        return $array;
    }
    private function processStructure($uid, $structure, $partIdentifier = null) {
        $parameters = $this->getParametersFromStructure($structure);
        if ((isset($parameters['name']) || isset($parameters['filename'])) || (isset($structure->subtype) && strtolower($structure->subtype) == 'rfc822')
        ) {
            if (isset($parameters['filename'])) {
                $this->setFileName($parameters['filename']);
            } elseif (isset($parameters['name'])) {
                $this->setFileName($parameters['name']);
            }
            $this->encoding = $structure->encoding;
            $result_save = $this->saveToDirectory($uid, $partIdentifier);
            $this->attachments[] = $result_save;
        } elseif ($structure->type == 0 || $structure->type == 1) {
            $messageBody = isset($partIdentifier) ?
                    imap_fetchbody($this->imapStream, $uid, $partIdentifier, FT_UID | FT_PEEK) : imap_body($this->imapStream, $uid, FT_UID | FT_PEEK);
            $messageBody = $this->decodeMessage($messageBody, $structure->encoding);
            if (!empty($parameters['charset']) && $parameters['charset'] !== 'UTF-8') {
                if (function_exists('mb_convert_encoding')) {
                    if (!in_array($parameters['charset'], mb_list_encodings())) {
                        if ($structure->encoding === 0) {
                            $parameters['charset'] = 'US-ASCII';
                        } else {
                            $parameters['charset'] = 'UTF-8';
                        }
                    }
                    $messageBody = mb_convert_encoding($messageBody, 'UTF-8', $parameters['charset']);
                } else {
                    $messageBody = iconv($parameters['charset'], 'UTF-8//TRANSLIT', $messageBody);
                }
            }
            if (strtolower($structure->subtype) === 'plain' || ($structure->type == 1 && strtolower($structure->subtype) !== 'alternative')) {
                $this->plaintextMessage = '';
                $this->plaintextMessage .= trim(htmlentities($messageBody));
                $this->plaintextMessage = nl2br($this->plaintextMessage);
            } elseif (strtolower($structure->subtype) === 'html') {
                $this->htmlMessage = '';
                $this->htmlMessage .= $messageBody;
            }
        }
        if (isset($structure->parts)) {
            foreach ($structure->parts as $partIndex => $part) {
                $partId = $partIndex + 1;
                if (isset($partIdentifier))
                    $partId = $partIdentifier . '.' . $partId;
                $this->processStructure($uid, $part, $partId);
            }
        }
    }
    private function setFileName($text) {
        $this->filename = $this->decode($text);
    }
    private function saveToDirectory($uid, $partIdentifier) { //save attachments to directory
        $array = array();
        $array['part'] = $partIdentifier;
        $array['file'] = $this->filename;
        $array['encoding'] = $this->encoding;
        return $array;
    }
    private function decodeMessage($data, $encoding) {
        if (!is_numeric($encoding)) {
            $encoding = strtolower($encoding);
        }
        switch (true) {
            case $encoding === 'quoted-printable':
            case $encoding === 4:
                return quoted_printable_decode($data);
            case $encoding === 'base64':
            case $encoding === 3:
                return base64_decode($data);
            default:
                return $data;
        }
    }
    private function getParametersFromStructure($structure) {
        $parameters = array();
        if (isset($structure->parameters))
            foreach ($structure->parameters as $parameter)
                $parameters[strtolower($parameter->attribute)] = $parameter->value;
        if (isset($structure->dparameters))
            foreach ($structure->dparameters as $parameter)
                $parameters[strtolower($parameter->attribute)] = $parameter->value;
        return $parameters;
    }
    private function getOverview($uid) {
        $results = imap_fetch_overview($this->imapStream, $uid, FT_UID);
        $messageOverview = array_shift($results);
        if (!isset($messageOverview->date)) {
            $messageOverview->date = null;
        }
        return $messageOverview;
    }
    private function decode($text) {
        if (null === $text) {
            return null;
        }
        $result = '';
        foreach (imap_mime_header_decode($text) as $word) {
            $ch = 'default' === $word->charset ? 'ascii' : $word->charset;
            $result .= iconv($ch, 'utf-8', $word->text);
        }
        return $result;
    }
    private function processAddressObject($addresses) {
        $outputAddresses = array();
        if (is_array($addresses))
            foreach ($addresses as $address) {
                if (property_exists($address, 'mailbox') && $address->mailbox != 'undisclosed-recipients') {
                    $currentAddress = array();
                    $currentAddress['address'] = $address->mailbox . '@' . $address->host;
                    if (isset($address->personal)) {
                        $currentAddress['name'] = $this->decode($address->personal);
                    }
                    $outputAddresses = $currentAddress;
                }
            }
        return $outputAddresses;
    }
    private function getHeaders($uid) {
        $rawHeaders = $this->getRawHeaders($uid);
        $headerObject = imap_rfc822_parse_headers($rawHeaders);
        if (isset($headerObject->date)) {
            $headerObject->udate = strtotime($headerObject->date);
        } else {
            $headerObject->date = null;
            $headerObject->udate = null;
        }
        $this->headers = $headerObject;
        return $this->headers;
    }
    private function getRawHeaders($uid) {
        $rawHeaders = imap_fetchheader($this->imapStream, $uid, FT_UID);
        return $rawHeaders;
    }
    private function getStructure($uid) {
        $structure = imap_fetchstructure($this->imapStream, $uid, FT_UID);
        //my custom attachment download code
        $email_number=$uid;
        $inbox=$this->imapStream;
    //starts here
         $attachments = array();
        /* if any attachments found... */
        if(isset($structure->parts) && count($structure->parts)) 
        {
            for($i = 0; $i < count($structure->parts); $i++) 
            {
                $attachments[$i] = array(
                    'is_attachment' => false,
                    'filename' => '',
                    'name' => '',
                    'attachment' => ''
                );

                if($structure->parts[$i]->ifdparameters) 
                {
                    foreach($structure->parts[$i]->dparameters as $object) 
                    {
                        if(strtolower($object->attribute) == 'filename') 
                        {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['filename'] = $object->value;
                        }
                    }
                }

                if($structure->parts[$i]->ifparameters) 
                {
                    foreach($structure->parts[$i]->parameters as $object) 
                    {
                        if(strtolower($object->attribute) == 'name') 
                        {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['name'] = $object->value;
                        }
                    }
                }

                if($attachments[$i]['is_attachment']) 
                {
                    $attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i+1);

                    /* 3 = BASE64 encoding */
                    if($structure->parts[$i]->encoding == 3) 
                    { 
                        $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                    }
                    /* 4 = QUOTED-PRINTABLE encoding */
                    elseif($structure->parts[$i]->encoding == 4) 
                    { 
                        $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                    }
                }
            }
        }

$pathed='';
$filename='';
        /* iterate through each attachment and save it */
        foreach($attachments as $attachment)
        {
            if($attachment['is_attachment'] == 1)
            {
                $filename = $attachment['name'];
                if(empty($filename)) $filename = $attachment['filename'];

                if(empty($filename)) $filename = time() . ".dat";
                $folder = "https://hrm.zalegoinstitute.ac.ke/zalegosurvey/public/attachments";
                if(!is_dir($folder))
                {
                     mkdir($folder);
                }
                $fp = fopen("./". $folder ."/-" . $filename, "w+");
                $pathed="./". $folder ."/-" . $filename;
                fwrite($fp, $attachment['attachment']);
                fclose($fp);
            }
        }
        //ends here
        return $structure;
    }
    public function __destruct() {
        if (!empty($this->errors)) {
            foreach ($this->errors as $error) {
                //SAVE YOUR LOG OF ERRORS
            }
        }
    }


    //pull mails
    public function pullMails(){
    	$mails=DB::table('hrmis_mails')
    			->where('archive_status','=',0)
    			->get();
    			$mails2=DB::table('hrmis_mails')
    			->get();
    	$attachments=DB::table('mailattachments')
    				->get();
        $employees=DB::table('clients')
                    // ->where('achve_status','=',0)
                    ->get();
         $trashed=DB::table('hrmis_mails')
                ->where('archive_status','=',1)
                ->get();
    	$data=array('mails2'=>$mails2,'mails'=>$mails,'attachments'=>$attachments,'employees'=>$employees,'trashed'=>$trashed);
    	return view('bulks.mails')->with($data);

    }

      public function read_mail($id){
    	$mails=DB::table('hrmis_mails')
    			->where('archive_status','=',0)
    			->get();
        $trashed=DB::table('hrmis_mails')
                ->where('archive_status','=',1)
                ->get();
    	$attachments=DB::table('mailattachments')
    				->get();
    	$mails2=DB::table('hrmis_mails')
    			->where('archive_status','=',0)
    			->where('mailId','=',$id)
    			->get();
    	$attachments2=DB::table('mailattachments')
    	->where('comId','=',$id)
    				->get();
        $employees=DB::table('clients')
                    // ->where('achve_status','=',0)
                    ->get();
    	$data=array('mails'=>$mails,'attachments'=>$attachments,'mails2'=>$mails2,'attachments2'=>$attachments2,'employees'=>$employees,'trashed'=>$trashed);
    	return view('bulks.read_mail')->with($data);

    }

    public function archiveMail($id){
    	DB::update('UPDATE hrmis_mails SET archive_status=? WHERE mailId=?',[1,$id]);
    	return redirect('/z_mails');
    }

    public function compose_mail(){
        $mails=DB::table('hrmis_mails')
                ->where('archive_status','=',0)
                ->get();
                $mails2=DB::table('hrmis_mails')
                ->get();
        $attachments=DB::table('mailattachments')
                    ->get();
        $employees=DB::table('clients')
                    // ->where('achve_status','=',0)
                    ->get();
         $trashed=DB::table('hrmis_mails')
                ->where('archive_status','=',1)
                ->get();

        $data=array('mails'=>$mails,'attachments'=>$attachments,'employees'=>$employees,'trashed'=>$trashed);
        return view('bulks.compose_mail')->with($data);
    }

    public function composeMail(Request $request){
        //save attachments if present
            $mailSubject=$request->input('mailSubject');
            $mailMessage=$request->input('mailMessage');
            $mailRecipient=$request->input('mailRecipient');
            $draftCheck=$request->input('draftCheck');
             $created_at=date('Y-m-d')." ".date('h:i:s A');
            if($draftCheck==1){
                //save this as draft
                  $mailId=DB::table('hrmis_mails')->insertGetId([
                                'senderMail'=>$mailRecipient,
                                'senderName'=>Auth::user()->name,
                                'senderDate'=>$created_at,
                                'attachmentCount'=>0,
                                'delivery_status'=>3,
                                'senderSubject'=>$mailSubject,
                                'senderAddress'=>Auth::user()->email,
                                'senderMessage'=>$mailMessage
                            ]);
            //send email instead
            $folder="public/hrfiles";
            $cms_multiple_images=$request->file("attachment");
            $cms_page_image_name_to_store="";
            if($cms_multiple_images!=""){
                        foreach($cms_multiple_images as $cms_mult_images){

                        
                                        //get file name with extension
                    $cms_page_image_name_with_extension=$cms_mult_images->getClientOriginalName();
                                //get just File name
                                    $cms_page_image_file_name_only=pathinfo($cms_page_image_name_with_extension,PATHINFO_FILENAME);
                                //get just Extension
                                    $cms_page_image_extension_only=$cms_mult_images->getClientOriginalExtension();
                                        //timestamped file name to store
                                        $cms_page_image_name_to_store=$cms_page_image_file_name_only."_".time().".".$cms_page_image_extension_only;
                                    //upload the image
                                        $cms_page_image_path=$cms_mult_images->move($folder,$cms_page_image_name_to_store);
                            $insert2=DB::insert('INSERT INTO mailattachments(comId,docLink) VALUES(?,?)',[$mailId,$cms_page_image_name_to_store]);          
                    }

                           
            }
  Alert::success('Success','Draft saved successfully');
      return back();
            }else{
             $mailId=DB::table('hrmis_mails')->insertGetId([
                                'senderMail'=>$mailRecipient,
                                'delivery_status'=>1,
                                'attachmentCount'=>0,
                                'senderName'=>Auth::user()->name,
                                'senderDate'=>$created_at,
                                'senderSubject'=>$mailSubject,
                                'senderAddress'=>Auth::user()->email,
                                'senderMessage'=>$mailMessage
                            ]);
            //send email instead
            $folder="public/hrfiles";
            $cms_multiple_images=$request->file("attachment");
            $cms_page_image_name_to_store="";
            if($cms_multiple_images!=""){
                        foreach($cms_multiple_images as $cms_mult_images){

                        
                                        //get file name with extension
                    $cms_page_image_name_with_extension=$cms_mult_images->getClientOriginalName();
                                //get just File name
                                    $cms_page_image_file_name_only=pathinfo($cms_page_image_name_with_extension,PATHINFO_FILENAME);
                                //get just Extension
                                    $cms_page_image_extension_only=$cms_mult_images->getClientOriginalExtension();
                                        //timestamped file name to store
                                        $cms_page_image_name_to_store=$cms_page_image_file_name_only."_".time().".".$cms_page_image_extension_only;
                                    //upload the image
                                        $cms_page_image_path=$cms_mult_images->move($folder,$cms_page_image_name_to_store);
                            $insert2=DB::insert('INSERT INTO mailattachments(comId,docLink) VALUES(?,?)',[$mailId,$cms_page_image_name_to_store]);          
                    }

                           
            }

            //send the mails
            $getAttachments=DB::table('mailattachments')
                            ->where('comId','=',$mailId)
                            ->get();
            $getSignature=DB::table('mail_signatures')
                            ->where('signatureMail','=',Auth::user()->email)
                            ->get();
            $user=$mailRecipient;
            $data=array('getSignature'=>$getSignature,'getAttachments'=>$getAttachments,'mailMessage'=>$mailMessage,'mailSubject'=>$mailSubject);
            $this->subject=$mailSubject;
                    //return view('mails.imap_mail')->with($data);
                $send=Mail::send('mails.imap_mail', $data, function ($m) use ($user) {
                        $m->from('grace@atarahsolutions.co.ke', $this->subject);

                        $m->to($user)->subject($this->subject);
                        });
             Alert::success('Success','Mail sent successfully');
      return back();

            }
            
    }

    //set signature
    public function setSignature(Request $request){
        $signatureText=$request->input('textSignature');
        $signatureName=$request->input('signatureName');
        $signatureMail=$request->input('signatureMail');
        $created_at=date('Y-m-d')." ".date('h:i:s A');
        //check wether signature is set
        $check=DB::select('SELECT *FROM mail_signatures WHERE signatureMail=?',[$signatureMail]);
        if(count($check)>0){
             Alert::info('Info','Signature exists already.');
      return back();
        }
        if($signatureText!=""){
            DB::insert('INSERT INTO mail_signatures(signatureName,signatureCategory,signatureText,signatureMail,created_at) VALUES(?,?,?,?,?)',[$signatureName,'text',$signatureText,$signatureMail,$created_at]);
            return back()->with('success','Signature saved successfully');
        }else{
           $folder="public/hrfiles";
            $cms_mult_images=$request->file("signature");
            $cms_page_image_name_to_store="";
            if($cms_mult_images!=""){
                       

                        
                                        //get file name with extension
                    $cms_page_image_name_with_extension=$cms_mult_images->getClientOriginalName();
                                //get just File name
                                    $cms_page_image_file_name_only=pathinfo($cms_page_image_name_with_extension,PATHINFO_FILENAME);
                                //get just Extension
                                    $cms_page_image_extension_only=$cms_mult_images->getClientOriginalExtension();
                                        //timestamped file name to store
                                        $cms_page_image_name_to_store=str_replace(" ","_",$cms_page_image_file_name_only."_".time().".".$cms_page_image_extension_only);
                                    //upload the image
                                        $cms_page_image_path=$cms_mult_images->move($folder,$cms_page_image_name_to_store);
                            DB::insert('INSERT INTO mail_signatures(signatureName,signatureCategory,signatureText,signatureMail,created_at) VALUES(?,?,?,?,?)',[$signatureName,'image',$cms_page_image_name_to_store,$signatureMail,$created_at]);        
                  
                  
 Alert::success('Success','Signature saved successfully');
      return back();
                           
            }else{
                //prompt user to select file
                Alert::info('Info','Please select a file to proceed');
      return back();
            }
        }
         
    }

    //get signatures
    public function getSignatures(){
        $signatures=DB::table('mail_signatures')
                    ->get();
        $success=1;
        return response()->json(array('signatures'=>$signatures,'success'=>$success),200);
    }

    //delete signature
    public function deleteSignature($id)
    {
        $delete=DB::delete('DELETE FROM mail_signatures WHERE signatureId=?',[$id]);
        if($delete){
            Alert::success('Success','Signature deleted successfully');
      return back();
        }else{
            Alert::error('Error','Unable to delete signature');
       return back();
        }
    }

        public function drafts(){
        $mails=DB::table('hrmis_mails')
                ->where('archive_status','=',0)
                ->get();
        $attachments=DB::table('mailattachments')
                    ->get();
        
        $employees=DB::table('clients')
                    // ->where('achve_status','=',0)
                    ->get();
         $trashed=DB::table('hrmis_mails')
                ->where('archive_status','=',1)
                ->get();
        $data=array('mails'=>$mails,'attachments'=>$attachments,'employees'=>$employees,'trashed'=>$trashed);
        return view('bulks.drafts')->with($data);

    }
        public function trash(){
        $mails=DB::table('hrmis_mails')
                ->where('archive_status','=',0)
                ->get();
        $attachments=DB::table('mailattachments')
                    ->get();
        
        $employees=DB::table('clients')
                    // ->where('achve_status','=',0)
                    ->get();
         $trashed=DB::table('hrmis_mails')
                ->where('archive_status','=',1)
                ->get();
        $data=array('mails'=>$mails,'attachments'=>$attachments,'employees'=>$employees,'trashed'=>$trashed);
        return view('bulks.trash')->with($data);

    }

       public function sent(){
        $mails=DB::table('hrmis_mails')
                ->where('archive_status','=',0)
                ->get();
        $attachments=DB::table('mailattachments')
                    ->get();
        
        $employees=DB::table('clients')
                    // ->where('achve_status','=',0)
                    ->get();
         $trashed=DB::table('hrmis_mails')
                ->where('archive_status','=',1)
                ->get();
        $data=array('mails'=>$mails,'attachments'=>$attachments,'employees'=>$employees,'trashed'=>$trashed);
        return view('bulks.sent')->with($data);

    }

}
