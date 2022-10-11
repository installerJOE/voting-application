<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'phone_number',
        'subscribed',
        'profile_image',
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

    public function contestants(){
        return $this->hasMany(Contestant::class);
    }

    public function admin(){
        return $this->hasOne(Admin::class);
    }

    public function votes(){
        return $this->hasMany(Vote::class);
    }

    public function update_bio_data($request){
        $user = auth()->user();
        $updated_data = parent::update([
            "name" => $request->input('name') ?? $user->name,
            "username" => $request->input('username') ?? $user->username,
            "phone_number" => $request->input('phone_number') ?? $user->phone_number,
        ]);
    }

    public function update_profile_pic($request){
        $base64image = $request->input('profile_image');
        if(preg_match('/^data:image\/(\w+);base64,/', $base64image)){
            $data = substr($base64image, strpos($base64image, ',') + 1);
            $decoded_image = base64_decode($data);            

            $name = Str::slug(auth()->user()->name);
            
            // store image in directory
            $filename = strtolower($name . '-' . time() . '.jpg');
            Storage::disk('profile_image')->put($filename, $decoded_image);

            $this->update([
                "profile_image" => $filename
            ]);
            return true;
        }
        return false;
    }

    public function update_password($request){
        $this->update([
            "password" => Hash::make($request->input('password'))
        ]);
    }
}
