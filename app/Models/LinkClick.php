<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkClick extends Model
{
  use HasFactory, HasUuids;

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
