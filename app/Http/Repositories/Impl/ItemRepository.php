<?php

namespace App\Http\Repositories\Impl;

use Illuminate\Database\Eloquent\Collection;
use App\Http\Repositories\Contracts\ItemRepositoryInterface;
use App\Models\Item;

class ItemRepository implements ItemRepositoryInterface 
{
    public function __construct(
        private readonly Item $item
    ){}

    /**
     * Get all user's items
     * @param int $userId The user Id
     * @return Collections<Item>
     */
    public function getItems(int $userId): Collection
    {
        return $this->item->where('user_id', $userId)->get();
    }

    /**
     * Find item based on item id
     * @param int $itemId The item id
     * @param int $userId The user id
     * @return Item
     */
    public function findItem(int $itemId, int $userId): Item
    {
        return $this->item
            ->where('id', $itemId)
            ->where('user_id', $userId)
            ->firstOrFail();
    }

    /**
     * Create new item for user
     * @param array $data The new item data
     * @return Collections<Item>
     */
    public function createItem(int $userId, array $data): Item
    {
        $data['user_id'] = $userId;
        return $this->item->create($data);
    }

    /**
     * Update user's item
     * @param int $itemId The item id
     * @param int $userId The user id
     * @param array $data The updated data for item
     * @return Collections<Item>
     */
    public function updateItem(int $itemId, int $userId, array $data): Item
    {
        $item = $this->findItem($itemId, $userId);
        $item->update($data);
        return $item;
    }

    /**
     * Delete user item
     * @param int $userId
     * @param int $itemId
     * @return bool
     */
    public function deleteItem(int $itemId, int $userId): bool
    {
        $item = $this->findItem($itemId, $userId);
        return $item->delete();
    }
}