<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certifications extends Model
{
    use HasFactory;

    protected $table = "certifications";

    public function certiProvider()
    {
        return $this->hasOne('App\Models\CertificationProviders', 'id', 'provider_id');
    }
}
