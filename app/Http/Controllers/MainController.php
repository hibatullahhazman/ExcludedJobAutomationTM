<?php

namespace App\Http\Controllers;

use App\Models\excludelist;
use App\Models\aktiviti;
use App\Models\markinfo;
use App\Models\procedures;
use Hamcrest\Core\IsNot;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{

    public function index(){
        if(session()->has('login')){
        //check data
        $list = excludelist::with('markinfo','definition')
        ->select('excludeautomation.idproc','excludeautomation.nrproc','mark.denomark','mark.ctryorigin','bbastatusclassif.description','ptoprocedure.tooltips')
        //->with('bibliomark')
        ->join('procedures.ptoprocedure','ptoprocedure.idproc','=','excludeautomation.idproc')
        //->get();
        ->join('bibliomark.mark','excludeautomation.nrproc','=','mark.idapplication')
        ->join('definitions.bbastatusclassif','ptoprocedure.currentstatusid','=','bbastatusclassif.idstatus')
        ->get();
        //$list = excludelist::all();
        return view('home',compact('list'));
        //dd($list);
        }

        return redirect('login');
    }

    public function insert(){

        return view('tambah');
        
    }

    public function store($nrproc){

        if(session()->has('login')){
            $check = excludelist::where('nrproc',$nrproc)->get();
            if($check){
               $query = procedures::select('idproc','nrproc')
              ->where('nrproc',$nrproc)->first();

                if($query){

                    try {
                        //code...
                            $tambah = new excludelist();
                            $tambah->nrproc = $nrproc;
                            $tambah->idproc = $query->idproc;
                            $tambah->save();

                            //Cipta rekod logs bagi aktiviti yang dijalankan
                            $status = 1; //status pemprosesan = 0 - Failed : 1 - Succeed
                            $user = session('name'); //retrieved user->name from auth.session
                            $code = '1'; //activity-code = "Delete : 0" && "Insert : 1"
                    
                            $record = new aktiviti;
                            $record->user = $user;
                            $record->activity_code = $code;
                            $record->status = $status;
                            $record->nrproc = $nrproc;
                
                            $record->save(); //inserting the information into the existing table ('aktiviti')
                            //tamat di sini

                            session()->flash('success', 'Cap Dagangan '.$nrproc.' telah berjaya ditambahkan!');
                            return redirect()->back();                     
                    } catch (\Throwable $th) {
                        return back()->with('warning','Amaran: '.$nrproc.' telah pun wujud dalam senarai!');
                    }
                 
                }

            }
        }

        return redirect('login');

    }

    public function search(){

        if(request()->ajax()){
            $data = markinfo::where('idapplication', request()->search)->get();

            $output = '';

            if(count($data)>0){
                $output ='
                    <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">IDProc</th>
                        <th scope="col">Application No</th>
                        <th scope="col">Denomination</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                    </thead>
                    <tbody>';
                        foreach($data as $row){
                            $output .='
                            <tr>
                            <th scope="row">'.$row->idmark.'</th>
                            <td>'.$row->idapplication.'</td>
                            <td>'.$row->denomark.'</td>
                            <td><a href="'.url('tambah/'.$row->idapplication).'" onclick="return confirm(\'Sila tekan OK untuk teruskan?\');">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                            </svg>Tambah</a>
                            </td>
                            </tr>
                            ';
                        }
                $output .= '
                    </tbody>
                    </table>';
            }
            else{
                $output ='
                    <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">IDProc</th>
                        <th scope="col">Application No</th>
                        <th scope="col">Denomination</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                    </thead>
                    <tbody>
                            <tr>
                            <th scope="row"></th>
                            <td colspan="4" style="background-color:orange;"><b>Maaf, tiada sebarang rekod untuk nombor pemfailan ini!</b></td>
                            <td></td>
                            <td></td>
                            </tr>
                    </tbody>
                    </table>';
            }
            return $output;

        }
        
    }

    public function destroy($nrproc)
    {   

        if(session()->has('login')){
        $remove = excludelist::where('nrproc',$nrproc);
        $remove->delete();

        $status = 1; //status pemprosesan = 0 - Failed : 1 - Succeed
        $user = session('name'); //retrieved user->name from auth.session
        $code = '2'; //activity-code = "Delete"

        $record = new aktiviti;
        $record->user = $user;
        $record->activity_code = $code;
        $record->status = $status;
        $record->nrproc = $nrproc;

        $record->save(); //inserting the information into the existing table ('aktiviti')


        session()->flash('warning', 'Cap Dagangan '.$nrproc.' telah berjaya dikeluarkan!');

        return redirect()->back();
        }

        return redirect('login');
        
    }

}
