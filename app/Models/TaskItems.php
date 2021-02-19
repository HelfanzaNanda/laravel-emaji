<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskItems extends Model
{
    use HasFactory;
    protected $timestamps = false;

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
