<?php

namespace App\Http\Controllers;

use App\Models\Transition;
use Illuminate\Http\Request;
use http\Client\Response;
use App\Models\User;
class TransitionController extends Controller
{

    public function tomember(Request $request){

        $user=User::where('account_id','=',$request->account_id)->get();
        $user->remake=$request->remake;
        $user->c_try=$request->c_try;
        $user->amount=$request->amount;
        if ($user->save()) {
            return response()->json([
                'success' => false,
                'user'=>$user,
                'message' => 'Transition, created success fully'
            ], 201);
        }else{
            return response()->json([
                'danger' => false,
                'user'=>$user,
                'message' => 'Sorry, the transition cannot be created'
            ], 204);
        }
    }
}
