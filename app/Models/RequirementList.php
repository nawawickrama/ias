<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequirementList extends Model
{
    use HasFactory;

    protected $table = 'requirement_lists';

    protected $primaryKey = 'requirement_list_id';

    protected $fillable = [
        'name',
        'model'
    ];
}
