<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pnlinh\InfobipSms\Facades\InfobipSms;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\ActivityLog;
use App\Client;
use App\Group;
use Auth;
use DB;
use App\ GEmailEvent;
use Gate;
use Mail;
use App\Profile;
use response;

class MembersController extends Controller
{

public function index(){
$users=Client::orderBy('created_at','desc')->paginate(10);
$cGroup=Group::all();
return view('clients.index',compact('users','cGroup'))->with('count', (request()->input('page',1) -1)*10);
}


public function addClient(){
    $data =request()->validate([
        'firstName'=>['nullable','min:2'],
        'middleName'=>['nullable'],
        'lastName'=>['nullable','min:2'],
        'email'=>['required','unique:clients','email'],
        'group_id'=>['required'],
    ]);
    Client::create($data);
    Alert::success('Success','Member Has Been Added');
    return redirect('members');
}

public function sortGroup(){
$users=Client::where('group_id',request('filter'))->orderBy('created_at','desc')->paginate(10);
$category=Group::find(request('filter'));
$cGroup=Group::all();
return view('clients.index',compact('users','cGroup','category'))
            ->with('count', (request()->input('page',1) -1)*10);
}



public function sortEmail(){
    $sortEmail=request('sortEmail');
$users=Client::where('email','LIKE','%'.$sortEmail.'%')->orWhere('firstName','LIKE','%'.$sortEmail.'%')->orWhere('middleName','LIKE','%'.$sortEmail.'%')
                ->orWhere('lastName','LIKE','%'.$sortEmail.'%')->orderBy('created_at','desc')->paginate(10);
// $category=Group::find(request('sortEmail'));
$cGroup=Group::all();
return view('clients.index',compact('users','cGroup','sortEmail'))
            ->with('count', (request()->input('page',1) -1)*10);
}

public function update(Request $request, $user){
    if (Gate::allows('isAdmin')){
        abort('404');
    }
    $data = request()->validate([
        'firstName'=>['nullable','min:2','max:20'],
        'middleName'=>['nullable','min:2','max:20'],
        'lastName'=>['nullable','min:2','max:20'],
        'email'=>['nullable','email'],
        'phone'=>['nullable'],
        'location'=>['nullable'],
        'workPlace'=>['nullable'],
        'group_id'=>['nullable']
    ]);
    Client::find($user)->update($data);
    Alert::success('Success','Member Has Been Updated');
    return redirect('/members');
}

public function updateViewClient(Request $request, $client ){
    if (Gate::allows('isAdmin')){
        abort(404);
    }
    $data = request()->validate([
        'firstName'=>['min:2','max:20'],
        'middleName'=>['required','min:2','max:20'],
        'lastName'=>['required','min:2','max:20'],
        'email'=>['required','email'],
        'phone'=>['required'],
        'location'=>['required'],
        'workPlace'=>['required'],
        'group_id'=>['required']
    ]);
    Client::find($client)->update($data);
    Alert::success('Success','Member Has Been Updated');
    return redirect()->back();
}


public function searchClient(){
$search=request('search');
if($search!=''){

    $users=Client::where('firstName','Like','%'.$search.'%')
                ->orWhere('middleName','Like','%'.$search.'%')
                ->orWhere('lastName','Like','%'.$search.'%')
                ->orWhere('email','Like','%'.$search.'%')
                ->orWhere('group_id','Like','%'.$search.'%')
                ->orderBy('created_at','desc')->paginate(10);
    $cGroup=Group::all();

if(count($users)>0){
return view('clients.index',compact('users','cGroup'))
            ->with('count', (request()->input('page',1) -1)*10);
}else{
    Alert::info('Info','No results found');
    return redirect('/members');
}
}else{
    return redirect('/members');
}

}


    public function clientsPDF(){
        if (Gate::allows('isAdmin')){
            abort(404);
        }
        $clients=DB::table('clients')
            ->join('groups','groups.id','clients.group_id')
            ->select('clients.group_id','clients.firstName','clients.middleName','clients.lastName','clients.phone','clients.email','groups.name','clients.location', 'clients.workPlace','clients.created_at')
            ->orderBy('clients.created_at','desc')
            ->get();
        view()->share(['clients'=>$clients]);
        $pdf = PDF::loadView('downloads.membersPDF')->setPaper('a4','landscape');
        return $pdf->download('members.pdf');
    }


    public function deleteClient($id){
        $delete=Client::find($id)->delete();
        return back();
    }


}
