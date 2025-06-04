<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
  use HasFactory, UuidTrait, SoftDeletes;

  protected $fillable = [
    'user_id',
    'url',
    'short_url',
  ];

  protected $dates = [
    'deleted_at',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function clicks()
  {
    return $this->hasMany(LinkClick::class);
  }
}
