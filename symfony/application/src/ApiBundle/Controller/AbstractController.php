<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\Call;
use ApiBundle\Repository\CallRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AbstractController
 * @author Rafael Silveira <rsilveiracc@gmail.com>
 * @package ApiBundle\Controller
 */
abstract class AbstractController extends Controller
{
    /**
     * @param $responseContent
     * @param int $responseCode
     * @return JsonResponse
     */
    protected function createResponse($responseContent, $responseCode = null) : JsonResponse
    {
        if ($responseContent instanceof \Exception) {
            $responseCode = !$responseCode ? Response::HTTP_BAD_REQUEST : $responseCode;

            return new JsonResponse(
                [
                    'message' => $responseContent->getMessage(),
                    'type' => 'error',
                    'status' => 'error',
                    'file' => $responseContent->getFile(),
                    'line' => $responseContent->getLine(),
                ],
                $responseCode
            );
        }

        $responseCode = !$responseCode ? Response::HTTP_OK : $responseCode;
        return new JsonResponse(
            $responseContent,
            $responseCode
        );
    }

    /**
     * @return CallRepository
     */
    protected function getCallRepository() : CallRepository
    {
       return $this
                ->getDoctrine()
                ->getManager()
                ->getRepository(Call::class);
    }
}