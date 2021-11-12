<?php

namespace App\Repositories;

use App\Models\Biography;

class BiographyRepositery
{
    /**
     * @var Biography $biography
     */
    protected $biography;

    public function __construct(Biography $biography)
    {
        $this->biography = $biography;
    }

    /**
     * get bigraphy from storage.
     * @return object
     */
    public function getBiographyFromStorage(): object
    {
        return $this->biography->latest()->first();
    }

    /**
     * Update biography in storage.
     *
     * @param Type|int $id
     * @param Type|string $biography
     * @param Type|string $imagePath
     * @return bool
     */
    public function updateBiographyAtStorage(int $id, string $biography, string $imagePath): bool
    {
        try {
            $this->biography->where('id', $id)
            ->update(['biography' => $biography, 'image' => $imagePath]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
