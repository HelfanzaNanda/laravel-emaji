<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskResult extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
    }

    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function task_result_items()
    {
        return $this->hasMany(TaskResultItems::class, 'task_result_id');
    }
}
