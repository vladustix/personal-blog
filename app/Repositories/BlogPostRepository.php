<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * class BlogPostRepository
 *
 * @package App\Repositories
 */

class BlogPostRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить список статей для вывода в списке
     *
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate()
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->with(['category' => function ($query) {
                    $query->select(['id', 'title']);
                },
                'user:id,name',
                ])
            ->paginate(25);

        return $result;
    }

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }
}
