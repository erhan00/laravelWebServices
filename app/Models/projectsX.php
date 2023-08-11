<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projectsX extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $primaryKey = 'ID';

    public function issuesGet(){

        return $this->hasManyThrough(issuesX::class, usersX::class, 'PROJECT_ID', 'ID', 'ID');


    }
}
