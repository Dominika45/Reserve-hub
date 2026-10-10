<?php

namespace App\Enum;

enum ItemStatus: string
{
    case AVAILABLE = 'available';
    case RESERVED = 'reserved';
    case UNAVAILABLE = 'unavailable';
}