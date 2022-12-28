<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Loan
 *
 * @property $id
 * @property $description
 * @property $active
 * @property $condition
 * @property $people_id
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 * @property $estimated_date
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class loan extends Model
{
    static $rules = [
        'people_id' => 'required',
        'user_id' => 'required',
    ];
    protected $perPage = 20;

    protected $fillable = ['condition','description', 'active','people_id','user_id', 'estimated_date'];

    public function people()
    {
      return $this->hasOne('App\Models\People', 'id','people_id');
    }
    public function user()
    {
      return $this->hasOne('App\Models\User', 'id','user_id');
    }

    public function inventories()
    {
        return $this->hasOne(Inventory::class, 'loans_details', 'loans_id', 'inventory_id');
    }

}
