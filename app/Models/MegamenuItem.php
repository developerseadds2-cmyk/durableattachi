<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MegamenuItem extends Model
{
    protected $fillable = ['column_id', 'label', 'url', 'icon', 'is_highlighted', 'sort_order'];

    protected $casts = ['is_highlighted' => 'boolean'];

    public function column()
    {
        return $this->belongsTo(MegamenuColumn::class, 'column_id');
    }
}
