<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
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
        'password',
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

    public function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::make($password);
    }

    public function roles(){

        return $this->belongsToMany('App\Models\Role');
    }
    /**
     * Check i f the user has a role
     * @param string $role
     * @return boolean(true or null)
     */
    public function hasAnyRole(string $role)
    {
        //For any logged in User we can call the hasAnyRole method we just created
        //and we can pass in a string so we could pass in say admin here,
        // this will call our roles relationship for the current logged in user
        // and it is going to check the name column and then it's going to check
        //wether taht role we passed in in this case admin
        // and if it does then that is going to set to true, so it is return true
        // but if it doesn't then it's going to return null.
        // This gives us a nice way to just check wether a user has a role or they
        //don't which is a good start
        return null !== $this->roles()->where('name' , $role)->first();
    }
    /**
     * Check the user has anygiven role
     * @param array
     * @return boolean(true or null)
     */
    public function hasAnyRoles(array $role)
    {
        //This time it is take in an array and the problem is
        //this "where" method that's built into Eloquent is only chceking for
        //a string
        // So this array we're passing in won't work and will throw an error
        // but Lravel Eloquent has an other method called "where in " which takes
        //an array
        // This allows us to pass in an array for checking everything which is in the
        // array is in the name column.
        // And if it will return true if not it will return null
        return null !== $this->roles()->whereIN('name' ,$role)->first();
    }


}
