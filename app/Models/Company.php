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
    'zipcodeer',
    'zipcode',
    'street',
    'number',
    'complement',
    'neighborhood',
    'state',
    'city',
  ];
}
