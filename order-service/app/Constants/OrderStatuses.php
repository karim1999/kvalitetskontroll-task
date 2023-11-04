<?php

namespace App\Constants;

use App\Traits\HasEnumValues;

enum OrderStatuses: string
{
    use HasEnumValues;
    case PENDING = 'Pending';
    case IN_PROGRESS = 'In Progress';
    case FAILED = 'Failed';
    case COMPLETED = 'Completed';
}
