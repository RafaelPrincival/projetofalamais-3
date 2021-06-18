<?php
namespace ApiBundle\Service\Normalize;

use ApiBundle\Entity\Call;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Class CallNormalizer
 * @author Rafael Silveira <rsilveiracc@gmail.com>
 * @package ApiBundle\Service\Normalize
 */
class CallNormalizer
{
    private $serializer;

    public function __construct()
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    public function normalize(Call $call)
    {
        return $this->serializer->normalize($call);
    }
}