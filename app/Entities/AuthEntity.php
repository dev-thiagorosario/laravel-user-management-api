<?php

declare(strict_types=1);

namespace App\Entities;

use App\Entities\UserEntity;

final class AuthEntity
{
    protected string $token = '';
    protected ?int $userId = null;
    protected ?int $expiresIn = null;
    protected ?UserEntity $user = null;

    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUser(UserEntity $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getUser(): ?UserEntity
    {
        return $this->user;
    }

    public function setExpiresIn(?int $expiresIn): self
    {
        $this->expiresIn = $expiresIn;
        return $this;
    }

    public function getExpiresIn(): ?int
    {
        return $this->expiresIn;
    }

    public function toArray(): array
    {
        return [
            'token'      => $this->getToken(),
            'user_id'    => $this->getUserId(),
            'user'       => $this->user?->toArray(),
            'expires_in' => $this->getExpiresIn(),
        ];
    }
}
