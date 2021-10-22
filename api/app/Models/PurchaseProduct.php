<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseProduct extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'company_id',
    'purchase_id',
    'product_id',
    'amount',
    'sub_total',
  ];

  public function product ()
  {
    return $this->belongsTo('App\Models\Product');
  }

  public function purchase ()
  {
    return $this->belongsTo('App\Models\Purchase');
  }
}
