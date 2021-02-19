<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
}
