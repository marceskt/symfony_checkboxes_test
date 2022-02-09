<?php

namespace App\Controller;

use App\Entity\Permission;
use App\Entity\Profile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controlador perfiles
 */
class ProfileController extends AbstractController
{

	/**
	 * @Route(path="", methods={"GET"}, name="get.profiles.listview")
	 * @return Response
	 */
	public function getProfiles(): Response
	{
		$profiles = $this->getDoctrine()->getRepository(Profile::class)->findAll();
		return $this->render(
			'profiles.html.twig',
			array(
				'profiles' => $profiles,
			)
		);
	}

	/**
	 * @Route(path="/create", methods={"GET"}, name="get.profiles.create")
	 * @return Response
	 */
	public function getCreate(): Response
	{
		/** @var Permission[] $permissions */
		$permissions = $this->getDoctrine()->getRepository(Permission::class)->findAll();
		return $this->render(
			'profiles-form.html.twig',
			array(
				'permissions' => $permissions
			)
		);
	}

	/**
	 * @Route(path="/create", methods={"POST"}, name="post.profiles.create")
	 * @param Request $request
	 * @return Response
	 */
	public function postProfile(Request $request): Response
	{
		/** @var string $name */
		$name = $request->request->get('name');
		/** @var integer[] $permissionsId */
		$permissionsId = $request->request->get('permissions') ?? array();

		/** @var Permission[] $permissions */
		$permissions = $this->getDoctrine()->getRepository(Permission::class)
			->findBy(array( 'id' => $permissionsId ));

		$profile = new Profile();

		$profile->setName($name);

		foreach ($permissions as $permission) {
			$profile->addPermission($permission);
		}
		$em = $this->getDoctrine()->getManager();
		$em->persist($profile);
		$em->flush();

		return $this->redirectToRoute('get.profiles.listview');
	}

}