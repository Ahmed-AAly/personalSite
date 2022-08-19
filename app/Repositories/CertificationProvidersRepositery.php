<?php

namespace App\Repositories;

use App\Models\CertificationProviders;

class CertificationProvidersRepositery
{
    /**
     * @var CertificationProviders $certificationProviders
     */
    protected $certificationProviders;

    public function __construct(CertificationProviders $certificationProviders)
    {
        $this->certificationProviders = $certificationProviders;
    }

    /**
     * get full list of all courses providers
     * @return object
     */
    public function queryFullProvidersList(): object
    {
        return $this->certificationProviders->select('id', 'provider', 'provider_logo')->get();
    }
}
