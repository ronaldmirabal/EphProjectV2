<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Classroom
 *
 * @property $id
 * @property $name
 * @property $created_at
 * @property $updated_at
 *
 * @property Event[] $events
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Classroom extends Model
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
    public function events()
    {
        return $this->hasMany('App\Models\Event', 'classroom_id', 'id');
    }
    

}
