<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Medidas
 *
 * @ORM\Table(name="medidas", indexes={@ORM\Index(name="staff_id", columns={"staff_id"}), @ORM\Index(name="Medidas_FKIndex1", columns={"usuario_id"})})
 * @ORM\Entity
 */
class Medidas
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var float|null
     *
     * @ORM\Column(name="cuello", type="float", precision=10, scale=0, nullable=true)
     */
    private $cuello;

    /**
     * @var float|null
     *
     * @ORM\Column(name="hombro", type="float", precision=10, scale=0, nullable=true)
     */
    private $hombro;

    /**
     * @var float|null
     *
     * @ORM\Column(name="pecho", type="float", precision=10, scale=0, nullable=true)
     */
    private $pecho;

    /**
     * @var float|null
     *
     * @ORM\Column(name="brazo", type="float", precision=10, scale=0, nullable=true)
     */
    private $brazo;

    /**
     * @var float
     *
     * @ORM\Column(name="antebrazo", type="float", precision=10, scale=0, nullable=false)
     */
    private $antebrazo;

    /**
     * @var float|null
     *
     * @ORM\Column(name="cintura", type="float", precision=10, scale=0, nullable=true)
     */
    private $cintura;

    /**
     * @var float|null
     *
     * @ORM\Column(name="gluteos", type="float", precision=10, scale=0, nullable=true)
     */
    private $gluteos;

    /**
     * @var float|null
     *
     * @ORM\Column(name="pierna", type="float", precision=10, scale=0, nullable=true)
     */
    private $pierna;

    /**
     * @var float|null
     *
     * @ORM\Column(name="pantorrilla", type="float", precision=10, scale=0, nullable=true)
     */
    private $pantorrilla;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true)
     */
    private $fechaRegistro;

    /**
     * @var float|null
     *
     * @ORM\Column(name="pesokg", type="float", precision=10, scale=0, nullable=true)
     */
    private $pesokg;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="staff_id", referencedColumnName="id")
     * })
     */
    private $staff;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getCuello(): ?float
    {
        return $this->cuello;
    }

    public function setCuello(?float $cuello): self
    {
        $this->cuello = $cuello;

        return $this;
    }

    public function getHombro(): ?float
    {
        return $this->hombro;
    }

    public function setHombro(?float $hombro): self
    {
        $this->hombro = $hombro;

        return $this;
    }

    public function getPecho(): ?float
    {
        return $this->pecho;
    }

    public function setPecho(?float $pecho): self
    {
        $this->pecho = $pecho;

        return $this;
    }

    public function getBrazo(): ?float
    {
        return $this->brazo;
    }

    public function setBrazo(?float $brazo): self
    {
        $this->brazo = $brazo;

        return $this;
    }

    public function getAntebrazo(): ?float
    {
        return $this->antebrazo;
    }

    public function setAntebrazo(float $antebrazo): self
    {
        $this->antebrazo = $antebrazo;

        return $this;
    }

    public function getCintura(): ?float
    {
        return $this->cintura;
    }

    public function setCintura(?float $cintura): self
    {
        $this->cintura = $cintura;

        return $this;
    }

    public function getGluteos(): ?float
    {
        return $this->gluteos;
    }

    public function setGluteos(?float $gluteos): self
    {
        $this->gluteos = $gluteos;

        return $this;
    }

    public function getPierna(): ?float
    {
        return $this->pierna;
    }

    public function setPierna(?float $pierna): self
    {
        $this->pierna = $pierna;

        return $this;
    }

    public function getPantorrilla(): ?float
    {
        return $this->pantorrilla;
    }

    public function setPantorrilla(?float $pantorrilla): self
    {
        $this->pantorrilla = $pantorrilla;

        return $this;
    }

    public function getFechaRegistro(): ?\DateTimeInterface
    {
        return $this->fechaRegistro;
    }

    public function setFechaRegistro(?\DateTimeInterface $fechaRegistro): self
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    public function getPesokg(): ?float
    {
        return $this->pesokg;
    }

    public function setPesokg(?float $pesokg): self
    {
        $this->pesokg = $pesokg;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getStaff(): ?Usuario
    {
        return $this->staff;
    }

    public function setStaff(?Usuario $staff): self
    {
        $this->staff = $staff;

        return $this;
    }


}
