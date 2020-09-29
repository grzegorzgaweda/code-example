<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property integer parent_id
 */
class MenuElement extends Model
{
    protected $fillable = ['name', 'parent_id'];
}
