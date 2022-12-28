<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RemoveInventory
 *
 * @property $id
 * @property $description
 * @property $user_id
 * @property $inventory_id
 * @property $withdrawallist_id
 * @property $created_at
 * @property $updated_at
 * @property $date
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class RemoveInventory extends Model
{
    protected $table = 'remove-inventories';
    static $rules = [
        'inventory_id' => 'required',
        'user_id' => 'required',
        'withdrawallist_id' => 'required',
        'date' => 'required',
    ];
    protected $perPage = 20;

    protected $fillable = ['inventory_id','description','withdrawallist_id','user_id', 'date'];

    public function withdrawallist(){
        return $this->hasOne('App\Models\WithdrawalList', 'id','withdrawallist_id');
    }
    public function inventories()
    {
        return $this->hasOne('App\Models\Inventory', 'id','inventory_id');
    }
   

    public function user()
    {
      return $this->hasOne('App\Models\User', 'id','user_id');
    }
}
