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
  ];

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function purchase_products ()
  {
    return $this->hasMany('App\Models\PurchaseProduct');
  }
}
