<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    private static function uploadFile($file){
        $filename = time() . '-file' . '.' . $file->getClientOriginalExtension();
        $path = public_path('uploads/files');
        $file->move($path, $filename);
        return $filename;
    }

    public static function validateForm($params)
    {
        $rules = [
            'name' => ['required', 'string'],
            'file' => ['required', 'file', 'mimes:pdf'],
        ];

        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'string' => ':attribute harus bertipe teks',
            'mimes' => ':attribute harus bertipe :mimes',
        ];

        $attributes = [
            'name' => 'Nama',  
            'file' => 'File',
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
            $file = self::whereId($params['id'])->first();
            if ($request->file('file')) {
                $responseFile = self::uploadFile($request->file('file'));
            }
            $file->update([
                'name' => $params['name'] ?? $file->name,
                'file' => $request->file('file') ? $responseFile : $file->file,
            ]); 

            return [
                "url" => env("APP_URL").'/file',
                'status' => 'success',
                'message' => 'berhasil mengubah data !'
            ];
        }

        self::create([
            'name' => $params['name'],
            'file' => self::uploadFile($request->file('file')),
        ]);

        return [
            "url" => env("APP_URL").'/file',
            'status' => 'success',
            'message' => 'berhasil menambahkan data !'
        ];
    }
}
