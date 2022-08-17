<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InventoryTransfer
 *
 * @property $id
 * @property $description
 * @property $person_old
 * @property $person_new
 * @property $inventory_id
 * @property $created_at
 * @property $updated_at
 * @property $people_id
 *
 * @property Inventory $inventory
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class InventoryTransfer extends Model
{
    
    static $rules = [
		'description' => 'required',
		'person_old' => 'required',
		'person_new' => 'required',
		'inventory_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['description','person_old','person_new','inventory_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function inventory()
    {
        return $this->hasOne('App\Models\Inventory', 'id', 'inventory_id');
    }
    

}
