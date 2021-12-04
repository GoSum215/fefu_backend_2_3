<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $surname
 * @property string $name
 * @property string|null $patronymic
 * @property string $age
 * @property int $gender
 * @property string $phone
 * @property string $email
 * @property string $message
*/

class Appeal extends Model
{
    use HasFactory;
}
