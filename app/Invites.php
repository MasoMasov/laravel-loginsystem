<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invites extends Model
{
    protected $table = 'invites';
    protected $fillable = ['uid','email','icode'];
}
