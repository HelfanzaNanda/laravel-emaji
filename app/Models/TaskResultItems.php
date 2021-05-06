<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskResultItems extends Model
{
    protected $guarded = [];

    public function task_item()
    {
        return $this->belongsTo(TaskItems::class, 'task_item_id');
    }
}
