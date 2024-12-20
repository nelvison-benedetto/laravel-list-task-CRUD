<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Importa il trait HasFactory
class Task extends Model
{
    use HasFactory; // Aggiungi il trait, allows you to use factories to generate test or seed data for the Task model
}
