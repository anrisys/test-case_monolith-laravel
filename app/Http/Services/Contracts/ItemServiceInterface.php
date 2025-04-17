<?php

namespace App\Http\Services\Contracts;

use App\Models\Item;
use Illuminate\Database\Eloquent\Collection;

interface ItemServiceInterface 
{
    public function getUserItems(int $userId): Collection;
    public function findUserItem(int $itemId, int $userId): Item;
    public function createItem(array $data, int $userId): Item;
    public function updateItem(int $itemId, int $userId, array $data): Item;
    public function deleteItem(int $itemId, int $userId): bool;
}