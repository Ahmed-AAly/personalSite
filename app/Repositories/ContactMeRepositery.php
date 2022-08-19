<?php

namespace App\Repositories;

use App\Models\ContactMe;
use Illuminate\Support\Facades\DB;

class ContactMeRepositery
{
    /**
     * @var ContactMe $contactMe
     */
    protected $contactMe;

    public function __construct(ContactMe $contactMe)
    {
        $this->contactMe = $contactMe;
    }

    /**
     * Query storage for all messages.
     * @return object
     */
    public function queryAllMessages(): object
    {
        return $this->contactMe->select('id', 'contact_name', 'contact_email', 'contact_message', 'created_at')
        ->orderBy('created_at', 'desc')
        ->paginate(20);
    }

    /**
     * get count of all recived messages grouped by dates.
     * @param Type|int $year
     * @param Type|int $month
     * @return Type|int
     */
    public function getAllMessagesGroupedByDate(int $year, int $month): int
    {
        return $this->contactMe->select('id', 'created_at')
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->count();
    }

    /**
     * query storge for top 5 contacts.
     * @param Type|void
     * @return array
     */
    public function getTop5Contactes()
    {
        return $this->contactMe->select('contact_email', DB::raw('count(contact_email) as totalMessages'))
        ->groupBy('contact_email')
        ->orderBy('totalMessages', 'desc')
        ->limit(5)
        ->get()->toArray();
    }


    /**
     * store contact to storage.
     * @param Type|string $contactName
     * @param Type|string $contactEmail
     * @param Type|string $contactMessage
     * @return bool
     */
    public function storeContactToStorage(string $contactName, string $contactEmail, string $contactMessage): bool
    {
        try {
            $storeContact = $this->contactMe;
            $storeContact->contact_name = $contactName;
            $storeContact->contact_email  = $contactEmail;
            $storeContact->contact_message  = $contactMessage;
            $storeContact->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * removes message from storage.
     * @param Type|int $messageID
     */
    public function removeMessageQuery(int $messageID): bool
    {
        try {
            $this->contactMe->find($messageID)->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
