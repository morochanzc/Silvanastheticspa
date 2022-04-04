<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pagos
 *
 * @ORM\Table(name="pagos", indexes={@ORM\Index(name="pagos_FKIndex1", columns={"usuario_id"})})
 * @ORM\Entity
 */
class Pagos
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
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_genera_recibo", type="datetime", nullable=true)
     */
    private $fechaGeneraRecibo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="precio", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $precio;

    /**
     * @var int|null
     *
     * @ORM\Column(name="impuestos", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $impuestos;

    /**
     * @var int|null
     *
     * @ORM\Column(name="descuentos", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $descuentos;

    /**
     * @var int|null
     *
     * @ORM\Column(name="dias_operacion", type="bigint", nullable=true)
     */
    private $diasOperacion;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_pago", type="datetime", nullable=true)
     */
    private $fechaPago;

    /**
     * @var string|null
     *
     * @ORM\Column(name="soporte_pago", type="string", length=255, nullable=true)
     */
    private $soportePago;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_validacion_pago", type="datetime", nullable=true)
     */
    private $fechaValidacionPago;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_inicio", type="datetime", nullable=true)
     */
    private $fechaInicio;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_final", type="datetime", nullable=true)
     */
    private $fechaFinal;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="anulado", type="boolean", nullable=true)
     */
    private $anulado;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getFechaGeneraRecibo(): ?\DateTimeInterface
    {
        return $this->fechaGeneraRecibo;
    }

    public function setFechaGeneraRecibo(?\DateTimeInterface $fechaGeneraRecibo): self
    {
        $this->fechaGeneraRecibo = $fechaGeneraRecibo;

        return $this;
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(?int $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getImpuestos(): ?int
    {
        return $this->impuestos;
    }

    public function setImpuestos(?int $impuestos): self
    {
        $this->impuestos = $impuestos;

        return $this;
    }

    public function getDescuentos(): ?int
    {
        return $this->descuentos;
    }

    public function setDescuentos(?int $descuentos): self
    {
        $this->descuentos = $descuentos;

        return $this;
    }

    public function getDiasOperacion(): ?string
    {
        return $this->diasOperacion;
    }

    public function setDiasOperacion(?string $diasOperacion): self
    {
        $this->diasOperacion = $diasOperacion;

        return $this;
    }

    public function getFechaPago(): ?\DateTimeInterface
    {
        return $this->fechaPago;
    }

    public function setFechaPago(?\DateTimeInterface $fechaPago): self
    {
        $this->fechaPago = $fechaPago;

        return $this;
    }

    public function getSoportePago(): ?string
    {
        return $this->soportePago;
    }

    public function setSoportePago(?string $soportePago): self
    {
        $this->soportePago = $soportePago;

        return $this;
    }

    public function getFechaValidacionPago(): ?\DateTimeInterface
    {
        return $this->fechaValidacionPago;
    }

    public function setFechaValidacionPago(?\DateTimeInterface $fechaValidacionPago): self
    {
        $this->fechaValidacionPago = $fechaValidacionPago;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(?\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFinal(): ?\DateTimeInterface
    {
        return $this->fechaFinal;
    }

    public function setFechaFinal(?\DateTimeInterface $fechaFinal): self
    {
        $this->fechaFinal = $fechaFinal;

        return $this;
    }

    public function getAnulado(): ?bool
    {
        return $this->anulado;
    }

    public function setAnulado(?bool $anulado): self
    {
        $this->anulado = $anulado;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(?bool $activo): self
    {
        $this->activo = $activo;

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


}
