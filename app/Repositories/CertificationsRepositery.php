<?php

namespace App\Repositories;

use App\Models\Certifications;

class CertificationsRepositery
{
    /**
     * @var Certifications $certifications
     */
    protected $certifications;

    public function __construct(Certifications $certifications)
    {
        $this->certifications = $certifications;
    }

    /**
     * Query the DB for all user skills
     * @return object
     */
    public function queryCerts(): object
    {
        return $this->certifications->select('id', 'cert_name', 'provider_id', 'cert_url', 'acquired_at')
        ->with('certiProvider')
        ->orderBy('acquired_at', 'desc')
        ->get();
    }

    /**
     * stores new certification to DB
     * @param string $certificateName
     * @param string $certificateUrl
     * @param int $certificateProvider
     * @param string $dateAcquired
     * @param int $skillStatus
     * @return bool
     */
    public function addNewCert(
        string $certificateName,
        string $certificateUrl,
        int $certificateProvider,
        string $dateAcquired
    ): bool {

        try {
            $storeCert = $this->certifications;
            $storeCert->cert_name = $certificateName;
            $storeCert->cert_url  = $certificateUrl;
            $storeCert->provider_id  = $certificateProvider;
            $storeCert->acquired_at  = $dateAcquired;
            $storeCert->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }


    /**
     * stores new skills to DB
     * @param int $certificateID
     * @param string $certificateName
     * @param string $certificateUrl
     * @param int $certificateProvider
     * @param string $dateAcquired
     * @param int $skillStatus
     * @return bool
     */
    public function updateCertQuery(
        int $certificateID,
        string $certificateName,
        string $certificateUrl,
        int $certificateProvider,
        string $dateAcquired
    ): bool {

        try {
            $this->certifications->where('id', $certificateID)
            ->update(['cert_name' => $certificateName, 'cert_url' => $certificateUrl,
            'provider_id' => $certificateProvider
            , 'acquired_at' => $dateAcquired]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * removes skills from DB
     * @param int $certID
     */
    public function removeCertificateQuery(int $certID): bool
    {

        try {
            $this->certifications->find($certID)->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
