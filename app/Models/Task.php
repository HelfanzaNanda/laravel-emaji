<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public static function validateForm($params)
    {
        $rules = [
            'cycle_id.*' => ['required'],
            'tool_id' => ['required'],
            'body.*' => ['required'],
        ];

        $messages = [
            'required' => ':attribute tidak boleh kosong',
        ];

        $attributes = [
            'cycle_id' => 'Siklus',
            'tool_id' => 'Alat',
            'body' => 'Pertanyaan',
        ];

        return Validator::make($params, $rules, $messages, $attributes);
    }


    public static function createOrUpdate($params)
    {
        $validator = self::validateForm($params);
        if ($validator->fails()) {
            return [
                'status' => '422',
                'message' => $validator->getMessageBag()
            ];
        }
        DB::beginTransaction();

        try {
            
            if ($params['id']) {
                $task = self::whereId($params['id'])->first();
                $task->taskItems()->delete();
                $task->taskCycleItems()->delete();

                $task->update([
                    'tool_id' => $params['tool_id'],
                    'tools_used' => $params['tools_used'],
                ]);
        
                $task->taskItems()->create([
                    'body' => json_encode($params['body'])
                ]);
        
                $task->taskCycleItems()->create([
                    'cycle_id' => json_encode($params['cycle_id'])
                ]);

                DB::commit();
                return [
                    "url" => url("/") .'/tool',
                    'status' => 'success',
                    'message' => 'berhasil mengubah data !'
                ];
            }

            $task = self::create([
                'tool_id' => $params['tool_id'],
                'tools_used' => $params['tools_used'],
            ]);
            foreach ($params['body'] as $value) {
                $task->taskItems()->create([
                    'body' => $value
                ]);
            }
            foreach ($params['cycle_id'] as $value) {
                $task->taskCycleItems()->create([
                    'cycle_id' => $value
                ]);
            }
    
            DB::commit();
            return [
                "url" => url("/") .'/tool',
                'status' => 'success',
                'message' => 'berhasil menambahkan data !'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }

        
    }

    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }

    public function taskResults()
    {
        return $this->hasMany(TaskResult::class);
    }

    public function taskItems()
    {
        return $this->hasMany(TaskItems::class);
    }

    public function taskCycleItems()
    {
        return $this->hasMany(TaskCycleItems::class);
    }
}
