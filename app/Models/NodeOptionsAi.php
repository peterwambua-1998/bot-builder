<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NodeOptionsAi extends Model
{
    use HasFactory;

    protected $fillable = [
        'node_id',
        'type',
        'instructions',
        'out_of_context_msg',
        'temperature',
        'workflow',
        'tokens',
    ];
}
