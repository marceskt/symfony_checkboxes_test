<?php

namespace App\Entity;

use App\Repository\PermissionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entidad Permiso
 * @ORM\Entity(repositoryClass=PermissionRepository::class)
 */
class Permission
{
	/**
	 * @var integer $id
	 * @ORM\Id()
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @var integer $name
	 * @ORM\Column(type="string", length=60, unique=true)
	 */
	private $name;

	/**
	 * @var bool $checked (no se almacena)
	 */
	private $checked = false;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setName(string $name): self
	{
		$this->name = $name;

		return $this;
	}

	public function isChecked(): bool
	{
		return $this->checked;
	}

	public function setChecked(bool $checked): self
	{
		$this->checked = $checked;
		return $this;
	}

}
