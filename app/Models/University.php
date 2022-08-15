<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



/**
 * Class University
 *
 * @property $id
 * @property $name
 * @property $created_at
 * @property $updated_at
 * @property $address
 * @property $email
 * @property $phone
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class University extends Model
{
    static $rules = [
		'name' => 'required',
        'address' => 'required',
        'email' => 'required',
        'phone' => 'required',
    ];
    protected $perPage = 20;

     /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'address','email','phone'];

}
