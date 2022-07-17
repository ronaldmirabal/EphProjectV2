<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class People
 *
 * @property $id
 * @property $first_name
 * @property $last_name
 * @property $email
 * @property $phone
 * @property $active
 * @property $created_at
 * @property $updated_at
 * @property $type_people_id
 *
 * @property TypePeople $typePeople
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class People extends Model
{
    public $table =  'peoples';
    static $rules = [
		'first_name' => 'required',
		'last_name' => 'required',
		'email' => '',
		'phone' => '',
    'active' => '',
		'type_people_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name','last_name','email','phone','type_people_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function typePeople()
    {
        return $this->hasOne('App\Models\TypePeople', 'id', 'type_people_id');
    }
    

}
