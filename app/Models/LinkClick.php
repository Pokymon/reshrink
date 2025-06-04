<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkClick extends Model
{
  use HasFactory, UuidTrait;

  protected $fillable = [
    'link_id',
    'ip_address',
    'user_agent',
  ];

  public function link()
  {
    return $this->belongsTo(Link::class);
  }
}
