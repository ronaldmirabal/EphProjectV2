<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Event
 *
 * @property $id
 * @property $title
 * @property $description
 * @property $start
 * @property $end
 * @property $classroom_id
 * @property $people_id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Event extends Model
{
    static $rules = [
		'title' => 'required',
        'start' => 'required',
        'end' => 'required',
        'classroom_id' => 'required',
        'people_id' => 'required',
    ];

    protected $perPage = 20;

     /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title','start','end','classroom_id','people_id', 'description'];


    public function people()
    {
      return $this->hasOne('App\Models\People', 'id','people_id');
    }

    public function classroom()
    {
      return $this->hasOne('App\Models\Classroom', 'id','classroom_id');
    }


}
