<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
  use HasFactory, softDeletes;

  protected $fillable = [
    'company_id',
    'name',
    'document',
    'phone',
    'phone_secondary',

    'zipcode',
    'street',
    'number',
    'complement',
    'neighborhood',
    'state',
    'city',
  ];

  public function setDocumentAttribute($value)
  {
    $this->attributes['document'] = $this->clearField($value);
  }

  public function getDocumentAttribute($value)
  {
    if (!$value){
      return null;
    }

    return substr($value, 0, 3) . '.' . substr($value, 3, 3) . '.' . substr($value, 6, 3) . '-' . substr($value, 9, 2);
  }

  public function setPhoneAttribute($value)
  {
    $this->attributes['phone'] = $this->clearField($value);
  }

  public function getPhoneAttribute($value)
  {
    if (!$value){
      return null;
    }

    return '(' . substr($value, 0, 2) . ') ' . substr($value, 2, 5) . ' - ' . substr($value, 7, 9);
  }

  public function setPhoneSecondaryAttribute($value)
  {
    $this->attributes['phone_secondary'] = $this->clearField($value);
  }

  public function getPhoneSecondaryAttribute($value)
  {
    if (!$value){
      return null;
    }

    return '(' . substr($value, 0, 2) . ') ' . substr($value, 2, 5) . ' - ' . substr($value, 7, 9);
  }

  public function setZipcodeAttribute($value)
  {
    $this->attributes['zipcode'] = $this->clearField($value);
  }

  public function getZipcodeAttribute($value)
  {
    if (!$value) {
      return null;
    }

    return substr($value, 0, 2) . '.' . substr($value, 2, 3) . '-' . substr($value, 5, 6);
  }

  private function clearField(?string $param)
  {
    if (empty($param)) {
      return '';
    }

    return str_replace(['.', '-', '/', '(', ')', ' '], '', $param);
  }
}
