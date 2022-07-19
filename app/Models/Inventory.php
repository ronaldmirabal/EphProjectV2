<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Inventory
 *
 * @property $id
 * @property $stock
 * @property $model
 * @property $serial
 * @property $description
 * @property $noplaca
 * @property $color
 * @property $size
 * @property $active
 * @property $people_id
 * @property $brand_id
 * @property $area_id
 * @property $type_product_id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Inventory extends Model
{
    
    static $rules = [
		'people_id' => 'required',
		'brand_id' => 'required',
		'area_id' => 'required',
		'type_product_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['stock','model','serial','description','noplaca','color','size','active','people_id','brand_id','area_id','type_product_id'];

    public function brand()
    {
      return $this->hasOne('App\Models\Brand', 'id','brand_id');
    }
    public function area()
    {
      return $this->hasOne('App\Models\Area', 'id','area_id');
    }
    public function people()
    {
      return $this->hasOne('App\Models\People', 'id','people_id');
    }
    public function typeproduct()
    {
      return $this->hasOne('App\Models\TypeProduct', 'id','type_product_id');
    }
}
