<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'company_id',
    'user_id',
    'status',
    'payment_method',
    'total',
    'obs',
    'provider',
    'due_date'
  ];

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function purchase_products ()
  {
    return $this->hasMany('App\Models\PurchaseProduct');
  }

  public function setDueDateAttribute($value)
  {
    if (empty($value)) {
      $this->attributes['due_date'] = null;
    }  else {
      $time = strtotime($value);
      $this->attributes['due_date'] = date('Y-m-d', $time);
    }
  }

  public function setTotalAttribute($value)
  {
    if (empty($value)) {
      $this->attributes['total'] = null;
    } else {
      $this->attributes['total'] = floatval($this->convertStringToDouble($value));
    }
  }

  public function getTotalAttribute($value)
  {
    return $value;
  }

  private function convertStringToDouble(?string $param)
  {
    if (empty($param)) {
      return null;
    }

    return str_replace(',', '.', str_replace('.', '', $param));
  }
}
