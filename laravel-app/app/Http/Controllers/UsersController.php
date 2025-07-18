<?php

namespace App\Http\Controllers;

use App\Models\Banks;
use Illuminate\Http\Request;
use App\Models\User;
use DB;


class UsersController extends Controller
{
    public function index(Request $request){
        $banks = \Illuminate\Support\Facades\DB::table('banks')
        ->leftjoin('users', 'banks.user_id','=','users.account_id')
        ->select('banks.*','users.fname')
        ->where('user_id','=', $request -> user_id)
        ->get();
        $data = [
            'status' => '200',
            'bank detail' =>$banks
        ];
        return response()->json($data,200);
   }
   public function accountstatement(Request $request){
    $accstatement = \Illuminate\Support\Facades\DB::table('member')
        ->leftjoin('users','users.account_id','=','member.member_id')
      //  ->leftjoin('banks','users.account_id','=','banks.user_id')
        ->select('member.*','users.fname')
        ->where('user_id','=', $request -> user_id)
        ->get();
        $data = [
            'status' => '200',
            'bank detail' =>$accstatement
        ];
        return response()->json($data,200);

    }
}
