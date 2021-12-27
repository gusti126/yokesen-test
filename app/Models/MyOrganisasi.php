<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyOrganisasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'organisasi_id'
    ];

    public function organisasi()
    {
        return $this->belongsTo('App\Models\Organisasi');
    }
}
