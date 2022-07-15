<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Person
 *
 * @property $id
 * @property $first_name
 * @property $last_name
 * @property $email
 * @property $phone
 * @property $active
 * @property $created_at
 * @property $updated_at
 * @property $type_person_id
 *
 * @property TypePerson $typePerson
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Person extends Model
{
    
    static $rules = [
		'first_name' => 'required',
		'last_name' => 'required',
		'email' => 'required',
		'phone' => 'required',
		'active' => 'required',
		'type_person_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name','last_name','email','phone','active','type_person_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function typePerson()
    {
        return $this->hasOne('App\Models\TypePerson', 'id', 'type_person_id');
    }
    

}
