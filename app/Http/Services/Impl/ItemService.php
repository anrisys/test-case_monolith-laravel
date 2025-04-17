<?php

namespace App\Http\Services\Impl;

use App\Exceptions\BusinessLogicException;
use App\Http\Repositories\Contracts\ItemRepositoryInterface;
use App\Http\Services\Contracts\ItemServiceInterface;
use App\Models\Item;
use Illuminate\Database\Eloquent\Collection;

class ItemService implements ItemServiceInterface {

    public function __construct(private ItemRepositoryInterface $itemRepository){}

    /**
     * Get all user's items
     * @param int $userId The user Id
     * @return Collections<Item>
     */
    public function getUserItems(int $userId): Collection
    {
        return $this->itemRepository->getItems($userId);
    }

    /**
     * Find item based on item id
     * @param int $itemId The item id
     * @param int $userId The user id
     * @return Item
     */
    public function findUserItem(int $itemId, int $userId): Item
    {
        return $this->itemRepository->findItem($itemId, $userId);
    }

    /**
     * Create new item for user
     * @param array $data The new item data
     * @return Collections<Item>
     */
    public function createItem(array $data, int $userId): Item
    {
        return $this->itemRepository->createItem($userId, $data);
    }

    /**
     * Create new item for user
     * @param array $data The new item data
     * @return Collections<Item>
     */
    public function updateItem(int $itemId, int $userId, array $data): Item 
    {
        $this->findUserItem($itemId, $userId);
        return $this->itemRepository->updateItem($itemId, $userId, $data);
    }

    /**
     * Delete user item
     * @param int $userId
     * @param int $itemId
     * @return bool
     * @throws BusinessLogicException
     */
    public function deleteItem(int $itemId, int $userId): bool
    {
        $result = $this->itemRepository->deleteItem($itemId, $userId);

        if(!$result) {
            throw new BusinessLogicException("There is an error. Please try again.");
        }

        return $result;
    }
}