<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ContactMeRepositery;
use Exception;
use Illuminate\Support\Facades\log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ContactMeService
{
    /**
     * @var ContactMeRepositery $contactMeRepositery
     */
    protected $contactMeRepositery;

    public function __construct(ContactMeRepositery $contactMeRepositery)
    {
        $this->contactMeRepositery = $contactMeRepositery;
    }


    /**
     * return contact page to visitor
     * @return \Illuminate\Http\Response
     */
    public function contactForm()
    {
        return view('contact');
    }

    /**
     * get full list of stored certification records.
     * @return object
     */
    public function getAllContactMessages(): object
    {

        $getAllMessages = $this->contactMeRepositery->queryAllMessages();

        $monthlyMessagesTrend = $this->messageMonthlyTrend();

        $top5Contact = $this->contactMeRepositery->getTop5Contactes();

        return view('admin.home', compact('getAllMessages', 'monthlyMessagesTrend', 'top5Contact'));
    }

    /**
     * get total messages count grouped by month
     *
     * @param Type|void
     * @return void
     */
    public function messageMonthlyTrend()
    {
        $datesArray = [];
        $totalTrendArray = [];
        $startperiod = Carbon::now()->startOfYear()->subMonths(2)->format('Y-m');
        $endPeriod = Carbon::now()->endOfYear()->format('Y-m');
        $monthRange = CarbonPeriod::create($startperiod, '1 month', $endPeriod);

        foreach ($monthRange as $yearMonth) {
            $datesArray[] = Carbon::parse($yearMonth)->format('Y-m');
        }

        foreach ($datesArray as $key => $value) {
            $year = (int) Carbon::parse($value)->format('Y');
            $month = (int) Carbon::parse($value)->format('m');
            $getMonthlyTrend = $this->contactMeRepositery->getAllMessagesGroupedByDate($year, $month);
            $totalTrendArray[$value] = $getMonthlyTrend;
        }
        return $totalTrendArray;
    }


    /**
     * handles adding new certificate
     * @param object $request
     * @return \Illuminate\Http\Response
     */
    public function storeContact(object $request): object
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|min:3',
            'email' => 'required|email:rfc,dns|max:150',
            'message' => 'required|string|max:255|min:15',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to user
                ->withInput();
        }

        if (!$validator->fails()) {
            $storeContactMessage = $this->contactMeRepositery->storeContactToStorage(
                $request->name,
                $request->email,
                $request->message
            );

            if ($storeContactMessage) {
                return back()->with('messageSent', 'Your message was sucessfully sent');
            }
            if (!$storeContactMessage) {
                return back()->with('messageFailed', 'Opps failed to send message');
            }
        }
    }

    /**
     * handles removing messages request
     * @param object $request
     * @return \Illuminate\Http\Response
     */
    public function removeMessage(object $request): object
    {
        $validator = Validator::make($request->all(), [
            'meg_id' => 'required|numeric|exists:contact_mes,id',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to user
                ->withInput();
        }

        if (!$validator->fails()) {
            $removeMessage = $this->contactMeRepositery->removeMessageQuery((int) $request->meg_id);

            if ($removeMessage) {
                return back()->with('successstatus', 'Successfully deleted Message');
            }
            if (!$removeMessage) {
                return back()->with('failedstatus', 'Opps failed to delete Message');
            }
        }
    }
}
