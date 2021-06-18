<?php
/**
 * Created by PhpStorm.
 * User: rafael
 * Date: 29/09/18
 * Time: 10:51
 */

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CityCode
 *
 * @ORM\Table(name="city_codes")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\CityCodeRepository")
 */
class CityCode
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="code", type="string")
     */
    private $code;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param int $code
     *
     * @return CityCode
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

}