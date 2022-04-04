<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Producto
 *
 * @ORM\Table(name="producto", indexes={@ORM\Index(name="Producto_FKIndex1", columns={"tipo_producto_id"})})
 * @ORM\Entity
 */
class Producto
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
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="precio", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $precio;

    /**
     * @var int|null
     *
     * @ORM\Column(name="creditos", type="integer", nullable=true, options={"unsigned"=true,"comment"="creditos que aporta el producto."})
     */
    private $creditos;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true)
     */
    private $fechaRegistro;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imagen_producto", type="string", length=255, nullable=true)
     */
    private $imagenProducto;

    /**
     * @var \TipoProducto
     *
     * @ORM\ManyToOne(targetEntity="TipoProducto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_producto_id", referencedColumnName="id")
     * })
     */
    private $tipoProducto;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

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

    public function getCreditos(): ?int
    {
        return $this->creditos;
    }

    public function setCreditos(?int $creditos): self
    {
        $this->creditos = $creditos;

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

    public function getImagenProducto(): ?string
    {
        return $this->imagenProducto;
    }

    public function setImagenProducto(?string $imagenProducto): self
    {
        $this->imagenProducto = $imagenProducto;

        return $this;
    }

    public function getTipoProducto(): ?TipoProducto
    {
        return $this->tipoProducto;
    }

    public function setTipoProducto(?TipoProducto $tipoProducto): self
    {
        $this->tipoProducto = $tipoProducto;

        return $this;
    }


}
