<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    const TABLE_NAME = 'clients';
    const COLUMN_NAME = 'name';
    const COLUMN_NUMBER = 'number';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::COLUMN_NAME,
        self::COLUMN_NUMBER,
    ];
}
