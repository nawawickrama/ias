<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubForm extends Model
{
    use HasFactory;

    protected $table = 'sub_forms';

    protected $primaryKey = 'sub_form_id';

    protected $fillable = [
        'course_id',
        'form_id',
        'price',
    ];

    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Candidate::class, 'course_id');
    }
}
