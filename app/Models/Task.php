<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Importa il trait HasFactory
class Task extends Model
{
    use HasFactory; // Aggiungi il trait, allows you to use factories to generate test or seed data for the Task model
    // public function getRouteKeyName(){
    //     return 'slug';
    // }
    protected $fillable = ['title','description','long_description'];  //$fillable to explicity tell Laravel which properties can be mass asssigned
    //protected $guarded = []; not good x security, better use only $fillable
    public function toggleComplete(){
        $this->completed = !$this->completed; //this is $task
        $this->save();
    }
}
