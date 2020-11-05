<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'company_id',
    'category',
    'name',
    'price',
    'amount',
    'min_amount',
 ];

  public function setPriceAttribute($value)
  {
    if (empty($value)) {
      $this->attributes['price'] = null;
    } else {
      $this->attributes['price'] = floatval($this->convertStringToDouble($value));
    }
  }

  public function getPriceAttribute($value)
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
