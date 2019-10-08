<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App
 */
class Category extends Model
{
    public function items()
    {
        return $this->belongsToMany('App\Item', 'category_item', 'category_id', 'item_id');
    }
}
