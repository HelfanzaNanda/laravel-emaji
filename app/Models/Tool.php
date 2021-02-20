<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tool extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    //protected $fillable = ['id', 'name', 'slug', 'image'];
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function task()
    {
        return $this->hasOne(Task::class);
    }

    public static function uploadImage($img)
    {
        return cloudinary()->upload($img->getRealPath())->getSecurePath();
    }

    public static function validateForm($params)
    {
        $rules = [
            'name' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
        ];

        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'string' => ':attribute harus bertipe teks',
            'image' => ':attribute harus gambar',
            'mimes' => ':attribute harus bertipe :mimes',
            'max' => ':attribute maksimal :max MB',
        ];

        $attributes = [
            'name' => 'Nama',  
            'image' => 'Foto',  
        ];

        return Validator::make($params, $rules, $messages, $attributes);
    }

    public static function createOrUpdate($params, $request)
    {
        $validator = self::validateForm($params);
        if ($validator->fails()) {
            return [
                'status' => '422',
                'message' => $validator->getMessageBag()
            ];
        }

        if ($params['id']) {
            $tool = self::whereId($params['id'])->first();
            if ($request->file('image')) {
                $responseImage = self::uploadImage($request->file('image'));
            }
            $tool->update([
                'name' => $params['name'] ?? $tool->name,
                'image' => $request->file('image') ? $responseImage : $tool->image,
            ]);

            return [
                "url" => env("APP_URL").'/tool',
                'status' => 'success',
                'message' => 'berhasil mengubah data !'
            ];
            
        }

        self::create([
            'name' => $params['name'],
            'slug' => Str::slug($params['name']). '-'. Str::random(10),
            'image' => self::uploadImage($request->file('image')),
        ]);

        return [
            "url" => env("APP_URL").'/tool',
            'status' => 'success',
            'message' => 'berhasil menambahkan data !'
        ];
    }
}
