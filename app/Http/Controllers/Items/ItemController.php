<?php

namespace App\Http\Controllers\Items;

use App\Http\Controllers\Controller;
use App\Http\Requests\Items\CreateItemRequest;
use App\Http\Requests\Items\UpdateItemRequest;
use App\Http\Services\Contracts\ItemServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ItemController extends Controller
{
    public function __construct(private ItemServiceInterface $itemService) {}

    public function store(CreateItemRequest $request): RedirectResponse
    {
        $this->itemService->createItem($request->validated(), Auth::id());

        return redirect()->route('dashboard')
            ->with('success', 'Item created successfully.');
    }

    public function update(UpdateItemRequest $request, int $id): RedirectResponse
    {
        $this->itemService->updateItem($id, Auth::id(), $request->validated());

        return redirect()->route('dashboard')
            ->with('success', 'Item updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->itemService->deleteItem($id, Auth::id());

        return redirect()->route('dashboard')
            ->with('success', 'Item deleted.');
    }
}
