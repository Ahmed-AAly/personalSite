<?php

namespace App\Services;

use App\Repositories\CertificationProvidersRepositery;
use Exception;
use Illuminate\Support\Facades\log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class CertificationProvidersService
{
    /**
     * @var CertificationProvidersRepositery $certificationProvidersRepositery
     */
    protected $certificationProvidersRepositery;

    public function __construct(CertificationProvidersRepositery $certificationProvidersRepositery)
    {
        $this->certificationProvidersRepositery = $certificationProvidersRepositery;
    }
}
