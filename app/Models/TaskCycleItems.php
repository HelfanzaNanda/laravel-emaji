<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskCycleItems extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
    }
}
