<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use Symfony\Component\Uid\Uuid;

class  BaseDto
{
    #[ApiProperty(readable: false,writable: false,identifier: true)]
    public  $id = null;
    #[ApiProperty(readable: true,writable: false)]
    public ?bool $isActif = true;
}