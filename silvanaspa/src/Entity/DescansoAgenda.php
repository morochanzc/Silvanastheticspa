<?php

namespace App\Entity;

use App\Repository\DescansoAgendaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DescansoAgendaRepository::class)
 */
class DescansoAgenda
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $horaInicio;

    /**
     * @ORM\Column(type="time")
     */
    private $horaFin;

    /**
     * @ORM\ManyToOne(targetEntity=agenda::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $agenda;

    /**
     * @ORM\ManyToOne(targetEntity=Descanso::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $descanso;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHoraInicio(): ?\DateTimeInterface
    {
        return $this->horaInicio;
    }

    public function setHoraInicio(\DateTimeInterface $horaInicio): self
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    public function getHoraFin(): ?\DateTimeInterface
    {
        return $this->horaFin;
    }

    public function setHoraFin(\DateTimeInterface $horaFin): self
    {
        $this->horaFin = $horaFin;

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

    public function getDescanso(): ?descanso
    {
        return $this->descanso;
    }

    public function setDescanso(?descanso $descanso): self
    {
        $this->descanso = $descanso;

        return $this;
    }
}
