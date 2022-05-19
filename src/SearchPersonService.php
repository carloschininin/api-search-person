<?php

declare(strict_types=1);

/*
 * This file is part of the PIDIA.
 * (c) Carlos Chininin <cio@pidia.pe>
 */

namespace CarlosChininin\ApiSearchPerson;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SearchPersonService
{
    public function __construct(private readonly HttpClientInterface $httpClient)
    {
    }

    public function dni(string $document): ?PersonDTO
    {
        $endPoint = SearchEndpoint::DNI.$document;
        $result = $this->api($endPoint, 'GET');
        if (false === $result['status']) {
            return null;
        }

        $content = $result['data'];
        $person = new PersonDTO();
        $person->setDni($content['numeroDocumento']);
        $person->setNombreCompleto($content['nombre']);
        $person->setApellidoPaterno($content['apellidoPaterno']);
        $person->setApellidoMaterno($content['apellidoMaterno']);
        $person->setNombres($content['nombres']);

        return $person;
    }

    public function rucByDni(string $dni): ?PersonDTO
    {
        $endPoint = SearchEndpoint::RUC.SearchFactory::rucFactory($dni);
        $result = $this->api($endPoint, 'GET');
        if (false === $result['status']) {
            return null;
        }

        $content = $result['data'];
        $person = new PersonDTO();
        $person->setRuc($content['numeroDocumento']);
        $person->setNombreCompleto($content['nombre']);
        $person->setEstado($content['estado']);
        $person->setCondicion($content['condicion']);

        return $person;
    }

    public function ruc(string $document): ?PersonDTO
    {
        $endPoint = SearchEndpoint::RUC.$document;
        $result = $this->api($endPoint, 'GET');
        if (false === $result['status']) {
            return null;
        }

        $content = $result['data'];
        $person = new PersonDTO();
        $person->setRuc($content['numeroDocumento']);
        $person->setNombreCompleto($content['nombre']);
        $person->setEstado($content['estado']);
        $person->setCondicion($content['condicion']);
        $person->setDireccion($content['direccion']);

        return $person;
    }

    protected function api(string $url, string $method, bool $inArray = true, array $options = []): array
    {
        try {
            $response = $this->httpClient->request($method, $url, $options);
            $statusCode = $response->getStatusCode();

            if (200 !== $statusCode) {
                return ['status' => false, 'message' => 'Error en api'];
            }

            $content = $inArray ? $response->toArray() : $response->getContent();

            return ['status' => true, 'data' => $content];
        } catch (TransportExceptionInterface|ClientExceptionInterface|DecodingExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
}
