<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\CertificationsRepositery;
use App\Repositories\CertificationProvidersRepositery;
use Exception;
use Illuminate\Support\Facades\log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class CertificationsService
{
    /**
     * @var CertificationsRepositery $certificationsRepositery
     */
    protected $certificationsRepositery;

    /**
     * @var CertificationProvidersRepositery $certificationProvidersRepositery
     */
    protected $certificationProvidersRepositery;

    public function __construct(
        CertificationsRepositery $certificationsRepositery,
        CertificationProvidersRepositery $certificationProvidersRepositery
    ) {
        $this->certificationsRepositery = $certificationsRepositery;
        $this->certificationProvidersRepositery = $certificationProvidersRepositery;
    }


    /**
     * adminstration backend.
     * return all required data to load certificates view.
     * @return \Illuminate\Http\Response
     */
    public function userCertsIndex()
    {
        $getCertiList = $this->getAllCerts();

        $getCertProviders = $this->certificationProvidersRepositery->queryFullProvidersList();

        return view('admin.certifications', compact('getCertiList', 'getCertProviders'));
    }

    /**
     * get full list of stored certification records.
     * @return object
     */
    public function getAllCerts(): object
    {

        $getAllSkills = $this->certificationsRepositery->queryCerts();

        return $getAllSkills;
    }


    /**
     * adminstration backend.
     * handles adding new certificate request.
     * @param object $request
     * @return \Illuminate\Http\Response
     */
    public function addCertificate(object $request): object
    {
        $validator = Validator::make($request->all(), [
            'certificate_name' => 'required|string|max:255',
            'certificate_url' => 'required|string|max:255|active_url',
            'date_acquired' => 'required|date',
            'certificate_provider' => 'required|numeric|exists:certification_providers,id',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to user
                ->withInput();
        }

        if (!$validator->fails()) {
            $addNewCerti = $this->certificationsRepositery->addNewCert(
                $request->certificate_name,
                $request->certificate_url,
                (int) $request->certificate_provider,
                $request->date_acquired
            );

            if ($addNewCerti) {
                return back()->with('successstatus', __('backendLang.succaddCerti'));
            }
            if (!$addNewCerti) {
                return back()->with('failedstatus', __('backendLang.failedTOAddCerti'));
            }
        }
    }


    /**
     * handles updating certificate request.
     * @param object $request
     * @return \Illuminate\Http\Response
     */
    public function updateCertificate(object $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'cert_id' => 'required|numeric|exists:certifications,id',
            'certificate_name' => 'required|string|max:255',
            'certificate_url' => 'required|string|max:255|active_url',
            'date_acquired' => 'required|date',
            'certificate_provider' => 'required|numeric|exists:certification_providers,id',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to user
                ->withInput();
        }

        if (!$validator->fails()) {
            $updateCert = $this->certificationsRepositery->updateCertQuery(
                (int) $request->cert_id,
                $request->certificate_name,
                $request->certificate_url,
                (int) $request->certificate_provider,
                $request->date_acquired
            );

            if ($updateCert) {
                return back()->with('successstatus', __('backendLang.succUPdatCerti'));
            }
            if (!$updateCert) {
                return back()->with('failedstatus', __('backendLang.failedToUPdateCerti'));
            }
        }
    }

    /**
     * handles removing certificate request
     * @param object $request
     * @return \Illuminate\Http\Response
     */
    public function removeCertificate(object $request): object
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'cert_ID' => 'required|numeric|exists:certifications,id',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to user
                ->withInput();
        }

        if (!$validator->fails()) {
            $addNewSkill = $this->certificationsRepositery->removeCertificateQuery((int) $request->cert_ID);

            if ($addNewSkill) {
                return back()->with('successstatus', __('backendLang.succDeletCerti'));
            }
            if (!$addNewSkill) {
                return back()->with('failedstatus', __('backendLang.failedToDeletCerti'));
            }
        }
    }
}
