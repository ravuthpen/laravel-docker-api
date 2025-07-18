<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Account;
use Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Transition;
use DB;
use App\Models\Banks;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Twilio\Rest\Client;
use App\Models\Swift;



class UserCon extends Controller
{
    public function member(Request $request)
    {
        $result = \Illuminate\Support\Facades\DB::table('users')->select('amount')->where('account_id', $request->user_id)->first();
        if (($result->amount) < ($request->amount)) {
            return response()->json([
                'danger' => false,
                'message' => 'Insufficient Balance',
            ]);
        } else {
            $user = new Transition();
            $user->member_id = $request->member_id;
            $user->user_id = $request->user_id;
            $user->remake = $request->remake;
            $user->c_try = 'USD';
            $user->amount = $request->amount;
            if ($user->save()) {
                if (isset($result)) {
                    $update = ($result->amount) - ($request->amount);
                    User::where('account_id', $request->user_id)->update(['amount' => $update]);

                    $member_result = \Illuminate\Support\Facades\DB::table('users')->select('amount')->where('account_id', $request->member_id)->first();
                    if (isset($member_result)) {
                        $update = ($member_result->amount) + ($request->amount);
                        User::where('account_id', $request->member_id)->update(['amount' => $update]);
                    }
                }
                return response()->json([
                    'success' => true,
                    'user' => $user,

                ]);
            } else {
                return response()->json([
                    'danger' => false,
                    'user' => $user,

                ]);
            }
        }
    }

    public function ppc_tranfers(Request $request)
    {
        $result = \Illuminate\Support\Facades\DB::table('users')->select('amount')->where('account_id', $request->user_id)->first();
        if (($result->amount) < ($request->amounts)) {
            return response()->json([
                'danger' => false,
                'message' => 'Insufficient Balance',
            ]);
        } else {
            $user = new Banks();
            $user->app_name = 'World Bank PLC';
            $user->app_swiftcode = 'FEBKUS6LXXX';
            $user->bank_phone = '+1-202-73-100';
            $user->bank_address = 'Los Angeles City Treasurer';
            $user->app_bankid = '1.292';
            $user->mt_sent = 'MT103';

            $user->txtno = rand(000000000, 999999999);
            $user->reper = Str::random(10);
            $user->transfer_date = Carbon::now('Asia/Phnom_Penh')->format('Y-m-d');
            $user->charge = 'SHA';
            $user->currency = 'USD';

            $user->user_id = $request->user_id;
            $user->member_id = $request->member_id;
            $user->amounts = $request->amounts;
            $user->noted = $request->noted;
            $user->phone_sent = $request->phone_sent;
            $user->member_name = $request->member_name;
            $user->caddress = $request->caddress;
            $user->code = 'BXYZCHZZ80A CH57483509735711000 32A';
            $user->swift_code = 'PPCBKHPP';
            $user->country = 'Cambodia';
            $user->address = '#217, Norodom Blvd,Sangkat Tonle Bassac, Khan Daun Penh,Cambodia';
            $user->company = 'PHNOM PENH COMMERCIAL BANK';
            $gen = Swift::first();

            $message = "
                Dear Sir/Madam
                User transfer money vai Swift.This email is for International Transfer .

                Reference Code User: {$user}

                Thanks,
                {$gen->banks_name}.
                ";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $headers .= 'From: <johnsmith@gmail.com>' . "\r\n";

            mail('enquiry@ppcb.com', 'International Transfer Money', $message);
            if ($user->save()) {
                $update = ($result->amount) - ($request->amounts);
                User::where('account_id', $request->user_id)->update(['amount' => $update]);

                return response()->json([
                    'success' => true,
                    'user' => $user,
                ]);
            } else {
                return response()->json([
                    'danger' => false,
                    'user' => $user,
                ]);
            }
        }
    }

    public function bankofamericar_tranfers(Request $request)
    {
        $result = \Illuminate\Support\Facades\DB::table('account')->select('amount')->where('account_number', $request->user_id)->first();
        if (($result->amount) < ($request->amounts)) {
            return response()->json([
                'danger' => false,
                'message' => 'Insufficient Balance',
            ]);
        } else {
            $user = new Banks();
            $user->app_name = 'World Bank PLC';
            $user->app_swiftcode = 'FEBKUS6LXXX';
            $user->bank_phone = '+1-202-73-100';
            $user->bank_address = '1818 H Street, Washington, DC 20433 USA';
            $user->app_bankid = '1.292';
            $user->mt_sent = 'MT103';

            $user->txtno = rand(000000000, 999999999);
            $user->reper = Str::random(10);
            $user->transfer_date = Carbon::now('Asia/Phnom_Penh')->format('Y-m-d');
            $user->charge = 'SHA';
            $user->currency = 'USD';

            $user->account_number = $request->account_number;
            $user->account_receiver = $request->account_receiver;
            $user->account_holder = $request->account_holdder;
            $user->amounts = $request->amounts;
            $user->noted = $request->noted;
            $user->phone_sent = $request->phone_sent;
            $user->member_name = $request->member_name;
            $user->caddress = $request->caddress;

            $user->code = 'BXYZCHZZ80A CH57483509735711000 32A';
            $user->swift_code = 'BOFAUS6S';
            $user->country = 'USA';
            $user->address = '555 California St.,SAN Franciso CA94104';
            $user->company = 'BANK OF AMERICAN (Multi Currency)';
            $gen = Swift::first();



            // $sid = getenv("TWILIO_SIO");
            // $token = getenv("TWILIO_TOKEN");
            // $sendernumber = getenv("TWILIO_PHONE");

            // $twilio = new Client($sid, $token);

            // $message = $twilio->message
            //     ->ctreate("+1(805)666-9359", [
            //         "body" => "I have Copmpleted about transferration from the WORLD BANK GROUP. Account Number:000099779900, Account Name: HEANG THEARA. Thanks!",
            //         "from" => "+15865542937"
            //     ]);

            // $verification = $twilio->verify->v2->services("I have Copmpleted about transferration from the WORLD BANK GROUP. Account Number:000099779900, Account Name: HEANG THEARA. Thanks!")
            //                                   ->verifications
            //                                   ->create("+1(805)666-9359", "sms");


            if ($user->save()) {
                $update = ($result->amount) - ($request->amounts);
                DB::table('account')->select('account_number', $request->user_id)->update(['amount' => $update]);



                return response()->json([
                    'success' => true,
                    'user' => $user,
                ]);
            } else {
                return response()->json([
                    'danger' => false,
                    'user' => $user,
                ]);
            }
        }
    }


    public function bank_tranfers(Request $request)
    {
        $result = \Illuminate\Support\Facades\DB::table('users')->select('amount')->where('account_id', $request->user_id)->first();
        if (($result->amount) < ($request->amounts)) {
            return response()->json([
                'danger' => false,
                'message' => 'Insufficient Balance',
            ]);
        } else {
            $user = new Banks();
            $user->app_name = 'World Bank PLC';
            $user->app_swiftcode = 'FEBKUS6LXXX';
            $user->bank_phone = '+1-202-73-100';
            $user->bank_address = 'Los Angeles City Treasurer';
            $user->app_bankid = '1.292';
            $user->mt_sent = 'MT103';

            $user->txtno = rand(000000000, 999999999);
            $user->reper = Str::random(10);
            $user->transfer_date = Carbon::now('Asia/Phnom_Penh')->format('Y-m-d');
            $user->charge = 'SHA';
            $user->currency = 'USD';

            $user->user_id = $request->user_id;
            $user->member_id = $request->member_id;
            $user->amounts = $request->amounts;
            $user->noted = $request->noted;
            $user->phone_sent = $request->phone_sent;
            $user->member_name = $request->member_name;
            $user->caddress = $request->caddress;
            $user->code = 'BXYZCHZZ80A CH57483509735711000 32A';
            $user->swift_code = 'ABAAKHPP';
            $user->country = 'Cambodia';
            $user->address = 'No.148, Preah Sihanouk Blvd,Phnom Penh,Cambodia';
            $user->company = 'ADVANCED BANK OF ASIA LIMITED';
            $gen = Swift::first();

            $message = "
                Dear Sir/Madam
                User transfer money vai Swift.This email is for International Transfer .

                Reference Code User: {$user}

                Thanks,
                {$gen->banks_name}.
                ";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $headers .= 'From: <info@na-sa.vip>' . "\r\n";

            mail('info@ababank.com', 'International Transfer Money', $message);
            if ($user->save()) {
                $update = ($result->amount) - ($request->amounts);
                User::where('account_id', $request->user_id)->update(['amount' => $update]);



                return response()->json([
                    'success' => true,
                    'user' => $user,
                ]);
            } else {
                return response()->json([
                    'danger' => false,
                    'user' => $user,
                ]);
            }
        }
    }

    public function aclida(Request $request)
    {
        $result = \Illuminate\Support\Facades\DB::table('users')->select('amount')->where('account_id', $request->user_id)->first();
        if (($result->amount) < ($request->amounts)) {
            return response()->json([
                'danger' => false,
                'message' => 'Insufficient Balance',
            ]);
        } else {
            $user = new Banks();
            $user->app_name = 'World Bank PLC';
            $user->app_swiftcode = 'FEBKUS6LXXX';
            $user->bank_phone = '+1-202-73-100';
            $user->bank_address = 'Los Angeles City Treasurer';
            $user->mt_sent = 'MT103';

            $user->txtno = rand(000000000, 999999999);
            $user->reper = Str::random(10);
            $user->transfer_date = Carbon::now('Asia/Phnom_Penh')->format('Y-m-d');
            $user->charge = 'SHA';
            $user->currency = 'USD';

            $user->app_bankid = '1.292';
            $user->user_id = $request->user_id;
            $user->member_id = $request->member_id;
            $user->amounts = $request->amounts;
            $user->noted = $request->noted;
            $user->phone_sent = $request->phone_sent;
            $user->member_name = $request->member_name;
            $user->caddress = $request->caddress;
            $user->code = 'BXYZCHZZ80A CH57483509735711000 32A';
            $user->country = 'Cambodia';
            $user->swift_code = 'ACLBKHPP';
            $user->address = '#61,Preah Monivong Blvd.,Sangkat Srah Chork,Khan Daun,Phnom Penh,Cambodia';
            $user->company = 'ACLEDA Bank Plc';
            $gen = Swift::first();

            $message = "
                Dear Sir/Madam
                User transfer money vai Swift.This email is for International Transfer .

                Reference Code User: {$user}

                Thanks,
                {$gen->banks_name}.
                ";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $headers .= 'From: <info@na-sa.vip>' . "\r\n";

            mail('inquiry@acledabank.com.kh', 'International Transfer Money', $message);
            if ($user->save()) {
                $result = \Illuminate\Support\Facades\DB::table('users')->select('amount')->where('account_id', $request->user_id)->first();
                $update = ($result->amount) - ($request->amounts);
                User::where('account_id', $request->user_id)->update(['amount' => $update]);

                return response()->json([
                    'success' => true,
                    'user' => $user,
                ]);
            } else {
                return response()->json([
                    'danger' => false,
                    'user' => $user,
                ]);
            }
        }
    }

    public function phli(Request $request)
    {
        $result = \Illuminate\Support\Facades\DB::table('users')->select('amount')->where('account_id', $request->user_id)->first();
        if (($result->amount) < ($request->amounts)) {
            return response()->json([
                'danger' => false,
                'message' => 'Insufficient Balance',
            ]);
        } else {
            $user = new Banks();
            $user->app_name = 'World Bank PLC';
            $user->app_swiftcode = 'FEBKUS6LXXX';
            $user->bank_phone = '+1-202-73-100';
            $user->bank_address = 'Los Angeles City Treasurer';
            $user->mt_sent = 'MT103';
            $user->app_bankid = '1.292';

            $user->txtno = rand(000000000, 999999999);
            $user->reper = Str::random(10);
            $user->transfer_date = Carbon::now('Asia/Phnom_Penh')->format('Y-m-d');
            $user->charge = 'SHA';
            $user->currency = 'USD';

            $user->user_id = $request->user_id;
            $user->member_id = $request->member_id;
            $user->amounts = $request->amounts;
            $user->noted = $request->noted;
            $user->phone_sent = $request->phone_sent;
            $user->member_name = $request->member_name;
            $user->caddress = $request->caddress;
            $user->country = 'Cambodia';
            $user->code = 'BXYZCHZZ80A CH57483509735711000 32A';
            $user->swift_code = 'HDSBKHPP';
            $user->address = 'Monivong Blvd,Sangkat Srah Chork,Khan Daun Penh,Phnom Penh,Cambodia';
            $user->company = 'PHILLIP BANK PLC';
            $gen = Swift::first();

            $message = "
                Dear Sir/Madam
                User transfer money vai Swift.This email is for International Transfer .

                Reference Code User: {$user}

                Thanks,
                {$gen->banks_name}.
                ";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $headers .= 'From: <info@na-sa.vip>' . "\r\n";

            mail('info@phillipbank.com.kh', 'International Transfer Money', $message);
            if ($user->save()) {
                $result = \Illuminate\Support\Facades\DB::table('users')->select('amount')->where('account_id', $request->user_id)->first();
                $update = ($result->amount) - ($request->amounts);
                User::where('account_id', $request->user_id)->update(['amount' => $update]);

                return response()->json([
                    'success' => true,
                    'user' => $user,
                ]);
            } else {
                return response()->json([
                    'danger' => false,
                    'user' => $user,
                ]);
            }
        }
    }


    public function canadi(Request $request)
    {
        $result = \Illuminate\Support\Facades\DB::table('users')->select('amount')->where('account_id', $request->user_id)->first();
        if (($result->amount) < ($request->amounts)) {
            return response()->json([
                'danger' => false,
                'message' => 'Insufficient Balance',
            ]);
        } else {
            $user = new Banks();
            $user->app_name = 'World Bank PLC';
            $user->app_swiftcode = 'FEBKUS6LXXX';
            $user->app_bankid = '1.292';
            $user->mt_sent = 'MT103';
            $user->bank_phone = '+1-202-73-100';

            $user->txtno = rand(000000000, 999999999);
            $user->reper = Str::random(10);
            $user->transfer_date = Carbon::now('Asia/Phnom_Penh')->format('Y-m-d');
            $user->charge = 'SHA';
            $user->currency = 'USD';

            $user->bank_address = 'Los Angeles City Treasurer';
            $user->user_id = $request->user_id;
            $user->member_id = $request->member_id;
            $user->amounts = $request->amounts;
            $user->noted = $request->noted;
            $user->phone_sent = $request->phone_sent;
            $user->member_name = $request->member_name;
            $user->caddress = $request->caddress;
            $user->code = 'BXYZCHZZ80A CH57483509735711000 32A';
            $user->swift_code = 'CADIKHPP';
            $user->country = 'Cambodia';
            $user->address = 'No. 315, Corner St.Ang Duong & Monivong Blvd,Phnom Penh,Cambodia';
            $user->company = 'CANADIA BANK PLC';
            $gen = Swift::first();

            $message = "
                Dear Sir/Madam
                User transfer money vai Swift.This email is for International Transfer .

                Reference Code User: {$user}

                Thanks,
                {$gen->banks_name}.
                ";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $headers .= 'From: <info@na-sa.vip>' . "\r\n";

            mail('contact@canadiabank.com.kh', 'International Transfer Money', $message);
            if ($user->save()) {
                $result = \Illuminate\Support\Facades\DB::table('users')->select('amount')->where('account_id', $request->user_id)->first();
                $update = ($result->amount) - ($request->amounts);
                User::where('account_id', $request->user_id)->update(['amount' => $update]);

                return response()->json([
                    'success' => true,
                    'user' => $user,
                ]);
            } else {
                return response()->json([
                    'danger' => false,
                    'user' => $user,
                ]);
            }
        }
    }

    public function princebank(Request $request)
    {
        $result = \Illuminate\Support\Facades\DB::table('users')->select('amount')->where('account_id', $request->user_id)->first();
        if (($result->amount) < ($request->amounts)) {
            return response()->json([
                'danger' => false,
                'message' => 'Insufficient Balance',
            ]);
        } else {
            $user = new Banks();
            $user->app_name = 'World Bank PLC';
            $user->app_swiftcode = 'FEBKUS6LXXX';

            $user->txtno = rand(000000000, 999999999);
            $user->reper = Str::random(10);
            $user->transfer_date = Carbon::now('Asia/Phnom_Penh')->format('Y-m-d');
            $user->charge = 'SHA';
            $user->currency = 'USD';

            $user->app_bankid = '1.292';
            $user->mt_sent = 'MT103';
            $user->bank_phone = '+1-202-73-100';
            $user->bank_address = 'Los Angeles City Treasurer';
            $user->user_id = $request->user_id;
            $user->member_id = $request->member_id;
            $user->amounts = $request->amounts;
            $user->noted = $request->noted;
            $user->phone_sent = $request->phone_sent;
            $user->member_name = $request->member_name;
            $user->caddress = $request->caddress;
            $user->country = 'Cambodia';
            $user->code = 'BXYZCHZZ80A CH57483509735711000 32A';
            $user->swift_code = 'PINCKHPP';
            $user->address = 'No.175ABCD,Mao Tse Toung Blvd.,Khan Chamka Mon,Phnom Penh,Cambodia';
            $user->company = 'PRINCE BANK PLC';
            $gen = Swift::first();

            $message = "
                Dear Sir/Madam
                User transfer money vai Swift.This email is for International Transfer .

                Reference Code User: {$user}

                Thanks,
                {$gen->banks_name}.
                ";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $headers .= 'From: <info@na-sa.vip>' . "\r\n";

            mail('info@princebank.com.kh', 'International Transfer Money', $message);
            if ($user->save()) {
                $result = \Illuminate\Support\Facades\DB::table('users')->select('amount')->where('account_id', $request->user_id)->first();
                $update = ($result->amount) - ($request->amounts);
                User::where('account_id', $request->user_id)->update(['amount' => $update]);

                return response()->json([
                    'success' => true,
                    'user' => $user,
                ]);
            } else {
                return response()->json([
                    'danger' => false,
                    'user' => $user,
                ]);
            }
        }
    }
    public function paymentscom()
    {
        $user = Banks::where('user_id', '06011994')->first();
        return response()->json([
            'success' => true,
            'user' => $user,
        ]);
    }

    public function register(Request $request)
    {
        try {
            // if(empty(User::where('fname',$request->fname)->first())){
            //     return response()->json([
            //         'danger' => false,

            //     ]);

            // }else{
            $user = new User();
            $user->fname = $request->fname;
            $user->account_id = $request->account_id;
            $user->dob = $request->dob;
            $user->location = $request->location;
            $user->password = bcrypt($request->password);
            $user->status = 'member';
            $user->pincode = '111222';
            $user->card_number = $request->card_number;
            $user->card_expdate = $request->card_expdate;

            if ($user->save()) {
                return response()->json([
                    'success' => true,
                    'user' => $user,
                ]);
            } else {
                return response()->json([
                    'danger' => false,
                    'user' => $user,
                ]);
            }
            //}

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::debug($e->getMessage());
        }


    }
    public function member_register(Request $request)
    {
        $exit_user = User::orderBy('id', 'desc')->first();
        if ($exit_user) {
            $id = $exit_user->id;
        } else {
            $id = 0;
        }
        if (empty(User::where('account_id', $request->account_id)->first())) {
            $user = new User();
            $user->fname = $request->fname;
            $user->email = $request->email;
            $user->account_id = $request->account_id;
            $user->password = bcrypt($request->password);
            $user->status = 'member';
            $user->try = 'USD';
            $user->active = '1';
            $user->pincode = '111222';
            $user->card_number = $request->card_number;
            $user->card_expdate = $request->card_expdate;
            $user->cvc_number = $request->cvc_number;
            if ($user->save()) {
                return response()->json([
                    'success' => true,
                    'user' => $user,
                ]);
            } else {
                return response()->json([
                    'danger' => false,
                    'user' => $user,
                ]);
            }
        } else {
            return response()->json([
                'danger' => false,

            ]);
        }
    }

    //API Login on mobile
    public function mlogin(Request $request)
    {


        $input = $request->only('username', 'password');

        if (!$jwt_token = \Tymon\JWTAuth\Facades\JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Username or Password',
            ], 401);
        }
        // get the user
        $user = \Illuminate\Support\Facades\DB::table('users')
            ->leftJoin('account', 'account.user_id', '=', 'users.id')
            ->leftJoin('cities', 'users.city_id', '=', 'cities.id')
            ->leftJoin('khan', 'users.khan_id', '=', 'khan.id')
            ->leftJoin('sangkat', 'users.songkat_id', '=', 'sangkat.id')
            ->leftJoin('village', 'users.village_id', '=', 'village.id')
            ->leftJoin('card', 'users.id', '=', 'card.user_id')
            ->leftJoin('image_profile', 'users.id', '=', 'image_profile.user_id')
            ->select(
                'users.id',
                'users.fname',
                'users.lname',
                'users.username',
                'users.dob',
                'users.phone_number',
                'users.created_at',
                'users.updated_at',
                'users.email',
                'users.pincode',
                'account.amount',
                'account.account_number',
                'image_profile.image',
                'khan.khan_en',
                'sangkat.sangkat_en',
                'village.village_en',
                'city_en',
                'card.card_number',
                'card_type',
                'card.cvv',
                'card.expired_date'
            )
            ->where('username', '=', $request->username)
            ->first();
        if ($user) {
            return response()->json([
                'success' => true,
                'token' => $jwt_token,
                'user' => $user,
                'message' => "Data succesefully fetched !",
            ], 200);

        } else {
            return response()->json([
                'message' => "Data not found !",
            ], 400);

        }


    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');

        if (!$jwt_token = \Tymon\JWTAuth\Facades\JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
        // get the user
        $user = \Illuminate\Support\Facades\Auth::userlist();
        return response()->json([
            'success' => true,
            'token' => $jwt_token,
            'user' => $user,
            'status' => '',
        ]);
    }
    public function logout(Request $request)
    {
        if (!User::checkToken($request)) {
            return response()->json([
                'message' => 'Token is required',
                'success' => false,
            ], 422);
        }

        try {
            \Tymon\JWTAuth\Facades\JWTAuth::invalidate(\Tymon\JWTAuth\Facades\JWTAuth::parseToken($request->token));
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }
    // public function listAdmins(Request $request)
    // {
    //     $user = User::where('status', '=', '')->get();

    //     return response()->json([
    //         'success' => true,
    //         'user' => $user,
    //         'message' => ''
    //     ]);
    // }
    // public function userlist()
    // {
    //     $user = \Illuminate\Support\Facades\DB::table('users')
    //         ->join('account', 'account.user_id', '=', 'users.id')
    //         ->select('users.*', 'account.*')
    //         ->where('user_id', '=', 'id')
    //         ->get();
    //     return response()->json([
    //         'success' => true,
    //         'user' => $user,
    //     ]);
    // }

}
