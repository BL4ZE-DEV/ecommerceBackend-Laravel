<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case INPROGRESS = 'inprogress';
    case COMPLETED = 'completed';
}
