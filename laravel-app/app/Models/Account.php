<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Account extends Model
{
    use HasFactory;
    
    protected $table = 'account';
    protected $fillable = [
        'id', 'user_id','account_number', 'amount'
    ];
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
}