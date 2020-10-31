<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'company_id',
    'name',
    'email',
    'password',
    'document',
    'phone',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * Get the identifier that will be stored in the subject claim of the JWT.
   *
   * @return mixed
   */
  public function getJWTIdentifier()
  {
    return $this->getKey();
  }

  /**
   * Return a key value array, containing any custom claims to be added to the JWT.
   *
   * @return array
   */
  public function getJWTCustomClaims()
  {
    return [];
  }


  public function company()
  {
    return $this->belongsTo('App\Models\Company');
  }

  public function setPasswordAttribute($value)
  {
    if (empty($value)) {
      unset($this->attributes['password']);
      return;
    }

    $this->attributes['password'] = bcrypt($value);
  }

  public function setDocumentAttribute($value)
  {
    $this->attributes['document'] = $this->clearField($value);
  }

  public function getDocumentAttribute($value)
  {
    return substr($value, 0, 3) . '.' . substr($value, 3, 3) . '.' . substr($value, 6, 3) . '-' . substr($value, 9, 2);
  }

  public function setPhoneAttribute($value)
  {
    $this->attributes['phone'] = $this->clearField($value);
  }

  private function convertStringToDouble(?string $param)
  {
    if (empty($param)) {
      return null;
    }

    return str_replace(',', '.', str_replace('.', '', $param));
  }

  private function convertStringToDate(?string $param)
  {
    if (empty($param)) {
      return null;
    }

    list($day, $month, $year) = explode('/', $param);
    return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
  }

  private function clearField(?string $param)
  {
    if (empty($param)) {
      return '';
    }

    return str_replace(['.', '-', '/', '(', ')', ' '], '', $param);
  }
}
