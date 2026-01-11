<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\ListUsersInputDTO;
use App\Models\User;

class ListUserRepository implements ListUserRepositoryInterface
{
    public function all(ListUsersInputDTO $dto): array
    {
        $query = User::query();

        if ($dto->search !== null && $dto->search !== '') {
            $terms = $dto->search;

            $query->where(function ($query) use ($terms) {
                $query->where('name', 'like', '%' . $terms . '%')
                    ->orWhere('email', 'like', '%' . $terms . '%');
            });
        }

        if (!empty($dto->orderBy)) {
            foreach ($dto->orderBy as $field => $direction) {
                if (is_int($field)) {
                    $field = (string) $direction;
                    $direction = $dto->direction ?? 'asc';
                }

                $direction = strtolower((string) $direction);
                if (!in_array($direction, ['asc', 'desc'], true)) {
                    $direction = 'asc';
                }

                $query->orderBy($field, $direction);
            }
        }

        $paginator = $query->paginate(
            $dto->perPage,
            ['*'],
            'page',
            $dto->page
        );

        return [
            'items' => $paginator->items(),
            'pagination' => [
                'page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'last_page' => $paginator->lastPage(),
            ],
        ];
    }
}
