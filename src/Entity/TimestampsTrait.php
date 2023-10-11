<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;

trait TimestampsTrait
{
    #[PrePersist]
    public function onPrePersist(): void
    {
        if (null === $this->createdAt) {
            $this->createdAt = new \DateTimeImmutable('now');
        }

        if ($this->updatedAt == null) {
            $this->updatedAt = new \DateTimeImmutable('now');
        }
    }

    #[PreUpdate]
    public function onPreUpdate(): void
    {
        $this->updatedAt = new \DateTimeImmutable('now');
    }
}
