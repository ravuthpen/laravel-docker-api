<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    //protected $table = 'account';

    public $timestamps = false;


    public function getUser()
    {
        $user = \Illuminate\Support\Facades\DB::table('users')
            ->join('account', 'account.user_id', '=', 'users.id')
            ->select('users.*', 'account.*')
            ->where('user_id', '=', '2')
            ->get();
        return response()->json([
            'success' => true,
            'user' => $user,
        ]);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'fname',
        'lname',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public static function checkToken($token)
    {
        if ($token->token) {
            return true;
        }
        return false;
    }
    public static function getCurrentUser($request)
    {
        if (!User::checkToken($request)) {
            return response()->json([
                'message' => 'Token is required'
            ], 422);
        }

        $user = \Tymon\JWTAuth\Facades\JWTAuth::parseToken()->authenticate();
        return $user;
    }
    // public $appends = [
    //     'image_url'
    // ];

    // public function getImageUrlAttribute()
    // {
    //     //return assert("/storage/app/public/.$this->image");
    //     return url(\Storage::url("app/public/{$this->image}"));
    // }


}
