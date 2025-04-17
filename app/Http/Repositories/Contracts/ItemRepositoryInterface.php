<?php

namespace App\Http\Repositories\Contracts;

use App\Models\Item;
use Illuminate\Database\Eloquent\Collection;

interface ItemRepositoryInterface {
    public function getItems(int $userId): Collection;
    public function findItem(int $itemId, int $userId): Item;
    public function createItem(int $userId, array $data): Item;
    public function updateItem(int $itemId, int $userId, array $data): Item;
    public function deleteItem(int $itemId, int $userId): bool;
}
