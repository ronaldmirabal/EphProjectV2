<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class inventory_history
 *
 * @property $id
 * @property $description
 * @property $inventory_id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class inventory_history extends Model
{
    protected $table = "inventory_history";

    static $rules = [
		'description' => 'required',
        'inventory_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['description','inventory_id'];
}
