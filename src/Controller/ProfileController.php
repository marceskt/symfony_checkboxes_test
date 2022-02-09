<?php

namespace App\Controller;

use App\Entity\Profile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

}