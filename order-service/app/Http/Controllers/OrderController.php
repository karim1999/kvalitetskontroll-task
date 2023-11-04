<?php

namespace App\Http\Controllers;

use App\Actions\ListOrdersAction;
use App\Http\Requests\ListProductRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderResourceCollection;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * List orders paginated
     * @param ListProductRequest $request
     * @param ListOrdersAction $listOrdersAction
     * @return OrderResourceCollection
     */
    public function index(ListProductRequest $request, ListOrdersAction $listOrdersAction): OrderResourceCollection
    {
        $validated = $request->validated();
        $page = $validated['page'] ?? 1;
        $perPage = $validated['per_page'] ?? 10;
        $userId = $validated['user_id'] ?? null;
        $data = $listOrdersAction->handle($page, $perPage, $userId);
        return new OrderResourceCollection($data);
    }

    /**
     * Show order by id
     * @param Order $order
     * @return OrderResource
     */
    public function show(Order $order): OrderResource
    {
        // We can use an action to get an order by id, but it's not necessary
        return new OrderResource($order);
    }
}
