<?php

declare(strict_types=1);

namespace App\DTO;

class ListUsersInputDTO
{
    public function __construct(
        public readonly ?string $search = null,
        public readonly int $page = 1,
        public readonly int $perPage = 10,
        public readonly array $orderBy = ['name' => 'asc'],
        public readonly ?string $direction = 'desc',
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            search: isset($data['search']) ? (string) $data['search'] : null,
            page: isset($data['page']) ? (int) $data['page'] : 1,
            perPage: isset($data['per_page']) ? (int) $data['per_page'] : 10,
            orderBy: isset($data['order_by']) ? (array) $data['order_by'] : ['name' => 'asc'],
            direction: isset($data['direction']) ? (string) $data['direction'] : 'desc',
        );
    }
}
