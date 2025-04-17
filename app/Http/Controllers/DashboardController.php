<?php

namespace App\Http\Controllers;

use App\Http\Services\Contracts\ItemServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __construct(private ItemServiceInterface $itemService) {}

    public function index(): Response
    {
        $userId = Auth::id();
        $items = $this->itemService->getUserItems($userId);
        return Inertia::render('Dashboard', ['items' => $items]);
    }
}
