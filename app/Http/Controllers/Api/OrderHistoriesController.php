<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\OrderHistory;

class OrderHistoriesController extends Controller
{
    
    public function index(Request $request) {
        $orderHistory = OrderHistory::query();

        $with = [];

        if ($request->query('batch')) {
            $batch = explode(',', $request->query('batch'));

            $with = $batch;
        }

        if ($request->query('filter')) {
            $filter = $request->query('filter');

            $orderHistory->whereHas('status', function ($query) use ($filter) {
                $query->where('name', $filter);
            });

        }

        return $orderHistory->with($with)->get();
    }

    public function show(Request $request, $id) {
        $with = [];

        if ($request->query('batch')) {
            $batch = explode(',', $request->query('batch'));

            $with = $batch;
        }

        return OrderHistory::with($with)->where('id', $id)
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
        
        $OrderHistory = OrderHistory::create($request->all());

        return response()->json($OrderHistory, 201);
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
