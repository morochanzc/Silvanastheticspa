<?php

namespace App\Entity;

use App\Repository\HorarioRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HorarioRepository::class)
 */
class Horario
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=agenda::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $agenda;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $festivo;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $dia;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $horaInicio;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $horaFin;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $duracion;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(?\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getFestivo(): ?bool
    {
        return $this->festivo;
    }

    public function setFestivo(?bool $festivo): self
    {
        $this->festivo = $festivo;

        return $this;
    }

    public function getDia(): ?string
    {
        return $this->dia;
    }

    public function setDia(?string $dia): self
    {
        $this->dia = $dia;

        return $this;
    }

    public function getHoraInicio(): ?\DateTimeInterface
    {
        return $this->horaInicio;
    }

    public function setHoraInicio(?\DateTimeInterface $horaInicio): self
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    public function getHoraFin(): ?\DateTimeInterface
    {
        return $this->horaFin;
    }

    public function setHoraFin(?\DateTimeInterface $horaFin): self
    {
        $this->horaFin = $horaFin;

        return $this;
    }

    public function getDuracion(): ?\DateTimeInterface
    {
        return $this->duracion;
    }

    public function setDuracion(?\DateTimeInterface $duracion): self
    {
        $this->duracion = $duracion;

        return $this;
    }
}
