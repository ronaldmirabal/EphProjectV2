<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Loan
 *
 * @property $description
 * @property $loans_id
 * @property $inventory_id
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class loan_detail extends Model
{
    protected $table = 'loans_details';
    static $rules = [
        'loans_id' => 'required',
        'inventory_id' => 'required',
    ];
    protected $perPage = 20;

    protected $fillable = ['loans_id','description', 'inventory_id'];

    public function inventory()
    {
      return $this->hasOne('App\Models\invenroty', 'id','inventory_id');
    }
    public function loan()
    {
      return $this->hasOne('App\Models\loan', 'id','loans_id');
    }

}
