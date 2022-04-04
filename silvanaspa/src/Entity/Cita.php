<?php

namespace App\Entity;

use App\Repository\CitaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CitaRepository::class)
 */
class Cita
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=duracion::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $duracion;

    /**
     * @ORM\ManyToOne(targetEntity=agenda::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $agenda;

    /**
     * @ORM\ManyToOne(targetEntity=usuario::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaCita;

    /**
     * @ORM\Column(type="time")
     */
    private $horaCita;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaRegistro;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuracion(): ?duracion
    {
        return $this->duracion;
    }

    public function setDuracion(?duracion $duracion): self
    {
        $this->duracion = $duracion;

        return $this;
    }

    public function getAgenda(): ?agenda
    {
        return $this->agenda;
    }

    public function setAgenda(?agenda $agenda): self
    {
        $this->agenda = $agenda;

        return $this;
    }

    public function getUsuario(): ?usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getFechaCita(): ?\DateTimeInterface
    {
        return $this->fechaCita;
    }

    public function setFechaCita(\DateTimeInterface $fechaCita): self
    {
        $this->fechaCita = $fechaCita;

        return $this;
    }

    public function getHoraCita(): ?\DateTimeInterface
    {
        return $this->horaCita;
    }

    public function setHoraCita(\DateTimeInterface $horaCita): self
    {
        $this->horaCita = $horaCita;

        return $this;
    }

    public function getFechaRegistro(): ?\DateTimeInterface
    {
        return $this->fechaRegistro;
    }

    public function setFechaRegistro(\DateTimeInterface $fechaRegistro): self
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }
}
