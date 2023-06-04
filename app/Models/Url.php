<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;
    protected $fillable = [
        'url',
        'code',
        'clicks',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function generateCode()
    {
        $code = substr(md5(uniqid(rand(), true)), 0, 6);
        if ($this->where('code', $code)->exists()) {
            $this->generateCode();
        }
        return $code;
    }
}
