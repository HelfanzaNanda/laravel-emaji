<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];


    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
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
