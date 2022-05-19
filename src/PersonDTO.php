<?php

declare(strict_types=1);

/*
 * This file is part of the PIDIA.
 * (c) Carlos Chininin <cio@pidia.pe>
 */

namespace CarlosChininin\ApiSearchPerson;

class PersonDTO implements \JsonSerializable
{
    private ?int $id;
    private ?string $nombreCompleto;
    private ?string $dni;
    private ?string $apellidoPaterno;
    private ?string $apellidoMaterno;
    private ?string $nombres;
    private ?string $ruc;
    private ?string $estado;
    private ?string $condicion;
    private ?string $direccion;
    private ?string $ubigeo;

    public function id(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function nombreCompleto(): ?string
    {
        return $this->nombreCompleto;
    }

    public function setNombreCompleto(?string $nombreCompleto): void
    {
        $this->nombreCompleto = $nombreCompleto;
    }

    public function dni(): ?string
    {
        return $this->dni;
    }

    public function setDni(?string $dni): void
    {
        $this->dni = $dni;
    }

    public function apellidoPaterno(): ?string
    {
        return $this->apellidoPaterno;
    }

    public function setApellidoPaterno(?string $apellidoPaterno): void
    {
        $this->apellidoPaterno = $apellidoPaterno;
    }

    public function apellidoMaterno(): ?string
    {
        return $this->apellidoMaterno;
    }

    public function setApellidoMaterno(?string $apellidoMaterno): void
    {
        $this->apellidoMaterno = $apellidoMaterno;
    }

    public function nombres(): ?string
    {
        return $this->nombres;
    }

    public function setNombres(?string $nombres): void
    {
        $this->nombres = $nombres;
    }

    public function ruc(): ?string
    {
        return $this->ruc;
    }

    public function setRuc(?string $ruc): void
    {
        $this->ruc = $ruc;
    }

    public function estado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): void
    {
        $this->estado = $estado;
    }

    public function condicion(): ?string
    {
        return $this->condicion;
    }

    public function setCondicion(?string $condicion): void
    {
        $this->condicion = $condicion;
    }

    public function direccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): void
    {
        $this->direccion = $direccion;
    }

    public function ubigeo(): ?string
    {
        return $this->ubigeo;
    }

    public function setUbigeo(?string $ubigeo): void
    {
        $this->ubigeo = $ubigeo;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
