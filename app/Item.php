<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 * @package App
 */
class Item extends Model
{
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_item', 'item_id', 'category_id');
    }
}
