<?php

declare(strict_types=1);

namespace App\Entities;

use App\Models\User;
use DateTimeInterface;
class UserEntity
{
    protected ?int $id = null;
    protected ?string $name = null;
    protected ?string $email = null;
    protected ?string $password = null;
    protected bool $firstLogin = false;
    protected bool $isActive = true;
    protected ?DateTimeInterface $lastLogin = null;
    protected ?DateTimeInterface $blockedUntil = null;
    protected ?DateTimeInterface $createdAt = null;
    protected ?DateTimeInterface $updatedAt = null;

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;
        return $this;
    }
    public function getPassword(): ?string
    {
        return $this->password;
    }
    public function setFirstLogin(bool $firstLogin): self
    {
        $this->firstLogin = $firstLogin;
        return $this;
    }
    public function getFirstLogin(): bool
    {
        return $this->firstLogin;
    }
    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }
    public function getIsActive(): bool
    {
        return $this->isActive;
    }
    public function setLastLogin(?DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;
        return $this;
    }
    public function getLastLogin(): ?DateTimeInterface
    {
        return $this->lastLogin;
    }
    public function setBlockedUntil(?DateTimeInterface $blockedUntil): self
    {
        $this->blockedUntil = $blockedUntil;
        return $this;
    }
    public function getBlockedUntil(): ?DateTimeInterface
    {
        return $this->blockedUntil;
    }
    public function setCreatedAt(?DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }
    public function setUpdatedAt(?DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public static function fromModel(User $model): self
    {
        $entity = new self();
        $entity->setId($model->id);
        $entity->setName($model->name);
        $entity->setEmail($model->email);
        $entity->setPassword($model->password);
        $entity->setFirstLogin((bool) ($model->first_login ?? false));
        $entity->setIsActive((bool) ($model->is_active ?? true));
        $entity->setLastLogin($model->last_login);
        $entity->setBlockedUntil($model->blocked_until);
        $entity->setCreatedAt($model->created_at);
        $entity->setUpdatedAt($model->updated_at);
        return $entity;
    }

    public function toArray(): array
    {
        return [
            'id'          => $this->getId(),
            'name'        => $this->getName(),
            'email'       => $this->getEmail(),
            'first_login' => $this->getFirstLogin(),
            'is_active'   => $this->getIsActive(),
            'last_login'  => $this->getLastLogin()?->format('Y-m-d H:i:s'),
            'blocked_until' => $this->getBlockedUntil()?->format('Y-m-d H:i:s'),
            'created_at'  => $this->getCreatedAt()?->format('Y-m-d H:i:s'),
            'updated_at'  => $this->getUpdatedAt()?->format('Y-m-d H:i:s'),
        ];
    }
}
