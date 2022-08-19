<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\BiographyRepositery;
use Exception;
use Illuminate\Support\Facades\log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Models\Biography;

class BiographyService
{
    /**
     * @var BiographyRepositery $biographyRepositery
     */
    protected $biographyRepositery;

    public function __construct(BiographyRepositery $biographyRepositery)
    {
        $this->biographyRepositery = $biographyRepositery;
    }

    /**
     * Admin biography homepage.
     * @param Type|null $var
     * @return object
     */
    public function getBiography(): object
    {
        $biography = $this->biographyRepositery->getBiographyFromStorage();
        return view('admin.aboutme', compact('biography'));
    }

    /**
     * update biography.
     * @param Type|object $request
     * @return Type|object \Illuminate\Http\Response
     */
    public function updateBiography(object $request): object
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric|exists:biographies,id',
            'mypic' => 'nullable|image|mimes:jpg,bmp,png,gif',
            'story' => 'required|string|max:50000',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        } else {
            if (is_null($request->file('mypic'))) {
                $path = Biography::find((int) $request->id);
                $imgPath = $path->image;
            }

            if (!is_null($request->file('mypic'))) {
                $path = Biography::find((int) $request->id);
                Storage::disk('customStorageFolder')->delete($path->image);
                $imgPath = $request->file('mypic')->store('biographyImg', 'customStorageFolder');
            }

            $updateBiography = $this->biographyRepositery
            ->updateBiographyAtStorage((int) $request->id, $request->story, $imgPath);

            if ($updateBiography) {
                return redirect()->back()->with('successstatus', __('backendLang.succBioUPdt'));
            }
            if (!$updateBiography) {
                return back()->with('failedstatus', __('backendLang.failedToUPdtBio'));
            }
        }
    }
}
