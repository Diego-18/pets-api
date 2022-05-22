<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $table = 'pet';

    protected $fillable = [
        'name',
        'category_fk',
        'tag_fk',
        'photoUrls',
        'status'
    ];
}
