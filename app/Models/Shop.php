<?php

namespace App\Models;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Shop extends Model implements Authenticatable
{
    use HasFactory;
  // Define the required methods for the Authenticatable interface
  public function getAuthIdentifierName()
  {
      return 'id';
  }

  public function getAuthIdentifier()
  {
      return $this->getKey();
  }

  public function getAuthPassword()
  {
      return $this->password;
  }

  // Define the 'remember me' token methods
  public function getRememberToken()
  {
      return $this->remember_token;
  }

  public function setRememberToken($value)
  {
      $this->remember_token = $value;
  }

  public function getRememberTokenName()
  {
      return 'remember_token';
  }

}
