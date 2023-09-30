<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormControl extends Model
{
    use HasFactory;
    protected $fillable = [
        'form_id',
        'label',
        'name',
        'type',
        'options',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
