<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class EmployeeDocument extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employee_id',
        'name',
        'url',
    ];

    public function getLink()
    {
        return Storage::disk('s3')->url($this->url);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
