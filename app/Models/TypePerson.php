<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TypePerson
 *
 * @property $id
 * @property $name
 * @property $created_at
 * @property $updated_at
 *
 * @property Person[] $persons
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TypePerson extends Model
{
    
    static $rules = [
		'name' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function persons()
    {
        return $this->hasMany('App\Models\Person', 'type_person_id', 'id');
    }
    

}
