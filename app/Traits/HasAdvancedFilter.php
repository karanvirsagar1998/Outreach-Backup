<?php

namespace App\Traits;

use Illuminate\Validation\ValidationException;

trait HasAdvancedFilter
{
    public function scopeAdvancedFilter($query)
    {
        return $this->processQuery($query, [
            'order_column' => request('sort', $this->primaryKey),
            'order_direction' => request('order', 'desc'),
            'limit' => request('limit', 10),
            's' => request('s', null),
            'f' => json_decode(request('f', null), true),
        ])
            ->paginate(request('limit', 10));
    }

    public function processQuery($query, $data)
    {
        $data = $this->processGlobalSearch($data);

        $v = validator()->make($data, [
            'order_column' => 'sometimes|required|in:' . $this->orderableColumns(),
            'order_direction' => 'sometimes|required|in:asc,desc',
            'limit' => 'sometimes|required|integer|min:1',
            's' => 'sometimes|nullable|string',
    
            // advanced filter
            'filter_match' => 'sometimes|required|in:and,or',
            'f' => 'sometimes|nullable|array',
            'f.*.column' => 'required|in:' . $this->whiteListColumns(),
            'f.*.operator' => 'required_with:f.*.column|in:' . $this->allowedOperators(),
            'f.*.query_1' => 'required',
            'f.*.query_2' => 'required_if:f.*.operator,between,not_between',
        ]);

        if ($v->fails()) {
            throw new ValidationException($v);
        }

        $data = $v->validated();

        return (new FilterQueryBuilder())->apply($query, $data);
    }

    protected function processGlobalSearch($data)
    {
        if (isset($data['f']) || !isset($data['s'])) {
            return $data;
        }

        $data['filter_match'] = 'or';
        
        $data['f'] = array_map(function ($column) use ($data) {
            return [
                'column' => $column,
                'operator' => 'contains',
                'query_1' => $data['s'],
            ];
        }, $this->filterable);

        return $data;
    }

    protected function orderableColumns()
    {
        if ($this->orderable) {
            return implode(',', $this->orderable);
        }
        return $this->primaryKey;
    }

    protected function whiteListColumns()
    {
        if ($this->filterable) {
            return implode(',', $this->filterable);
        }
        return $this->primaryKey;
    }

    protected function allowedOperators()
    {
        return implode(',', [
            'contains',
        ]);
    }
}