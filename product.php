<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function scopeFilter($query, array $filters)
    {
        if (!empty($filters['category'])) {
            $query->whereIn('category', $filters['category']);
        }

        if (!empty($filters['min_price'])) {
            $query->whereIn('min_price','>=', $filters['min_price']);
        }

        if (!empty($filters['max_price'])) {
            $query->whereIn('max_price','<=',$filters['max_price']);
        }

        if (!empty($filters('ratings'))) {
            $query->whereIn('ratings','<=',$filters['ratings']);
        }
    }
}
