<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class Skills
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $level = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'skills')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    // Getters and Setters...
}
