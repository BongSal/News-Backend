<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    protected $keyType = 'string';
    public $incrementing = false;

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    protected function toFilterableArray(): array
    {
        return [];
    }

    public function scopeFilter($query, $value)
    {
        if ($value) {
            $query->where(fn ($qb) => $this->applyFilter($qb, $value));
        }
    }

    private function applyFilter($query, $value)
    {
        $filterable = $this->toFilterableArray();
        foreach ($filterable as $filter) {
            $query->orWhere("{$this->getTable()}.$filter", 'iLike', "%$value%");
        }
    }

    public function imageUrl($column = null)
    {
        $column = $column ?: 'image';
        $image = $this->$column;
        return [
            'default' => route('files.show', "files/$image"),
            'thumbnail' => route('files.show', "files/thumbnails/$image"),
            'avatar' => route('files.show', "files/avatars/$image"),
        ];
    }
}
