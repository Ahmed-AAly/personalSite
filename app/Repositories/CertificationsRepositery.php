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
     * Query the storage for all user certificates
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
     * stores new certification to storage
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
     * update selected certificate.
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
     * removes certificate from storage.
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
