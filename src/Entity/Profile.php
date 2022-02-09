<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entidad Perfil
 * @ORM\Entity(repositoryClass=ProfileRepository::class)
 */
class Profile
{
	/**
	 * @var integer $id
	 * @ORM\Id()
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @var string $name
	 * @ORM\Column(type="string", length=60, unique=true)
	 */
	private $name;

	/**
	 * @var Permission[]|Collection $permissions
	 * @ORM\ManyToMany(targetEntity=Permission::class)
	 * @ORM\JoinColumn(onDelete="CASCADE")
	 */
	private $permissions;

	public function __construct()
	{
		$this->permissions = new ArrayCollection();
	}

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

	/**
	 * @return Collection|Permission[]
	 */
	public function getPermissions(): Collection
	{
		return $this->permissions;
	}

	public function addPermission(Permission $permission): self
	{
		if (!$this->permissions->contains($permission)) {
			$this->permissions[] = $permission;
		}

		return $this;
	}

	public function removePermission(Permission $permission): self
	{
		$this->permissions->removeElement($permission);

		return $this;
	}
}
