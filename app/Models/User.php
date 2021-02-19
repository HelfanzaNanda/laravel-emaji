<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Validation\Rule;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'email', 'password', 'role' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function taskResults()
    {
        return $this->hasMany(TaskResult::class);
    }

    public function isAdmin()
    {
        return $this->role == 'admin' ? true : false;
    }

    public function isTaskMaster()
    {
        return $this->role == 'pengawas' ? true : false;
    }

    public function isTester()
    {
        return $this->role == 'penguji' ? true : false;
    }

    public static function search($search)
    {
        return empty($search) ? static::query() : 
        static::where('name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%')
                ->orWhere('created_at', 'like', '%'.$search.'%');
    }

    public static function validateForm($params)
    {
        $rules = [
            'name' => ['required', 'string', 'min:5'],
            'email' => ['required', 'email', 'unique:users,email,' . optional($params)['id']],
            'role' => ['required', 'in:pengawas,penguji'],
        ];

        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'string' => ':attribute harus bertipe teks',
            'min' => ':attribute minimal :min',
            'unique' => ':attribute sudah pernah ditambahkan',
            'email' => ':attribute harus bertipe email',
            'in' => ':attribute harus diantara :in',
        ];

        $attributes = [
            'name' => 'Nama',  
            'email' => 'Email Address',
            'role' => 'Role',   
        ];

        return Validator::make($params, $rules, $messages, $attributes);
    }
}
