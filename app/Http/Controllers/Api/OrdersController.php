<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\Status;

class OrdersController extends Controller
{
    
    public function index(Request $request) {

        $order = Order::query();

        $limit = (int) $request->query('limit', 100);
        $sort = $request->query('sort', 'created_at');
        $direction = $request->query('direction', 'asc');
        
        
        $with = [];

        if ($request->query('batch')) {
            $batch = explode(',', $request->query('batch'));

            $with = $batch;
        }

        if ($request->query('status')) {
            $status = $request->query('status');

            $statusEntity = Status::where('name', $status)->first();
            $status_id = $statusEntity->id;

            if($key = array_search('order_histories', $with) !== false) {
                $order->whereHas('order_histories', function ($query) use ($status_id) {
                    $query->where('status_id', $status_id);
                });
            } if ($key = array_search('order_histories.status', $with) !== false) {
                $order->whereHas('order_histories', function ($query) use ($status_id) {
                    $query->with('status')
                        ->where('status_id', $status_id);
                });
            }

            if(isset($key)) {
                array_splice($with, 1, $key);
            }

            $order->whereHas('order_histories', function ($query) use ($status_id) {
                $query->where('status_id', $status_id);
            });

            $with['order_histories'] = function ($query) use ($status_id) {
                $query->where('status_id', $status_id);
                $query->with('status');
            };
        }

        if ($request->query('user_id')) {
            $user_id = $request->query('user_id');

            $order->where('user_id', $user_id);
        }

        if ($request->query('product_id')) {
            $product_id = $request->query('product_id');

            $order->where('product_id', $product_id);
        }

        return $order->with($with)
            ->orderBy($sort, $direction)
            ->paginate($limit);
    }

    public function show(Request $request, $id) {
        $with = [];

        if ($request->query('batch')) {
            $batch = explode(',', $request->query('batch'));

            $with = $batch;
        }

        return Order::with($with)->where('id', $id)
            ->first();
    }

    // public function showIntecations(Request $request, $id)
    // {
    //     return Client::with('interactions.user')
    //         ->where('id', $id)
    //         ->first();
    // }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = Order::create($request->all());

        return response()->json($order, 201);
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Client $client)
    // {
    //     $client->update($request->all());

    //     return response()->json($client, 200);
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function delete(Request $request, $id)
    // {
    //     $client = Client::findOrFail($id);
    //     $client->delete();

    //     return 204;
    // }
}
