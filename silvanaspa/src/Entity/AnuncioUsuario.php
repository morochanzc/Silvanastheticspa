<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnuncioUsuario
 *
 * @ORM\Table(name="anuncio_usuario", indexes={@ORM\Index(name="Anunciousuario_FKIndex2", columns={"anuncio_id"}), @ORM\Index(name="Anunciousuario_FKIndex1", columns={"usuario_id"})})
 * @ORM\Entity
 */
class AnuncioUsuario
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
     * @var bool|null
     *
     * @ORM\Column(name="visto", type="boolean", nullable=true)
     */
    private $visto;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_lectura", type="datetime", nullable=true)
     */
    private $fechaLectura;

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
     * @var \Anuncio
     *
     * @ORM\ManyToOne(targetEntity="Anuncio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="anuncio_id", referencedColumnName="id")
     * })
     */
    private $anuncio;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getVisto(): ?bool
    {
        return $this->visto;
    }

    public function setVisto(?bool $visto): self
    {
        $this->visto = $visto;

        return $this;
    }

    public function getFechaLectura(): ?\DateTimeInterface
    {
        return $this->fechaLectura;
    }

    public function setFechaLectura(?\DateTimeInterface $fechaLectura): self
    {
        $this->fechaLectura = $fechaLectura;

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

    public function getAnuncio(): ?Anuncio
    {
        return $this->anuncio;
    }

    public function setAnuncio(?Anuncio $anuncio): self
    {
        $this->anuncio = $anuncio;

        return $this;
    }


}
