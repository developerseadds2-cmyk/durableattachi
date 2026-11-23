<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MegamenuColumn extends Model
{
    protected $fillable = ['megamenu_id', 'title', 'sort_order'];

    public function megamenu()
    {
        return $this->belongsTo(Megamenu::class);
    }

    public function items()
    {
        return $this->hasMany(MegamenuItem::class, 'column_id')->orderBy('sort_order');
    }
}
