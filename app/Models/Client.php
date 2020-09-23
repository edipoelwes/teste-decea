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
}
