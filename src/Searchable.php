<?php

namespace BgpGroup\Searchable;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{

    public function scopeSearch(Builder $query, ?string $search) : Builder
    {
        return $query->when($search, function (Builder $query) use ($search) {

            $query->where(function (Builder $query) use ($search) {

                foreach (($this->searchable ?? []) as $field) {
                    $query->orWhere($field, 'like', '%' . $search . '%');
                }

                return $query; 
            });
            
        });
    }
}
