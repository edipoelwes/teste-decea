<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'social_name',
    'alias_name',
    'document_company',
    'document_company_secondary',
    'zipcode',
    'street',
    'number',
    'complement',
    'neighborhood',
    'state',
    'city',
  ];

  public function setDocumentCompanyAttribute($value)
  {
    $this->attributes['document_company'] = $this->clearField($value);
  }

  public function getDocumentCompanyAttribute($value)
  {
    return substr($value, 0, 2) . '.' . substr($value, 2, 3) . '.' . substr($value, 5, 3) . '/' . substr($value, 8, 4) . '-' . substr($value, 12, 2);
  }

  public function setDocumentCompanySecondaryAttribute($value)
  {
    $this->attributes['document_company_secondary'] = $this->clearField($value);
  }

  public function getDocumentCompanySecondaryAttribute($value)
  {
    return substr($value, 0, 7) . '-' . substr($value, 7, 8);
  }

  public function setZipcodeAttribute($value)
  {
    $this->attributes['zipcode'] = $this->clearField($value);
  }

  private function clearField(?string $param)
  {
    if (empty($param)) {
        return '';
    }

    return str_replace(['.', '-', '/', '(', ')', ' '], '', $param);
  }
}
