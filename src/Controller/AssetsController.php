<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function in_array;
use function json_encode;

/**
 * @Route("/assets")
 */
class AssetsController extends AbstractController
{
    /**
     * @Route("/", name="assets_json", methods={"GET"})
     */
    public function assets(User $user = null): Response
    {
        $assetRepository = $this->getDoctrine()
            ->getRepository(Asset::class);

        if ($user === null || ($user instanceof User && in_array('ROLE_ADMIN', $user->getRole()))) {
            $assets = $assetRepository->findAll();
        } else {
            $assets = $assetRepository->findBy(['groups' => $user->getGroups()]);
        }

        $assetNames = [];
        foreach ($assets as $asset) {
            $assetNames[] = $asset->getName();
        }

        return new JsonResponse(json_encode($assetNames));
    }
}
