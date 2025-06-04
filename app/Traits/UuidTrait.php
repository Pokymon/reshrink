<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

trait UuidTrait
{
  protected static function bootUuidTrait()
  {
    static::creating(function (Model $model) {
      if (empty($model->{$model->getKeyName()})) {
        $model->{$model->getKeyName()} = (string) Uuid::uuid7();
      }
    });

    static::retrieved(function (Model $model) {
      $model->setKeyType('string');
    });
  }

  public function getIncrementing()
  {
    return false;
  }
}
