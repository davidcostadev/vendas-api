<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Status;

class StatusesController extends Controller
{
    
    public function index(Request $request) {
        $with = [];

        if ($request->query('batch')) {
            $batch = explode(',', $request->query('batch'));

            $with = $batch;
        }

        return Status::with($with)->get();
    }

    public function show(Request $request, $id) {
        $with = [];

        if ($request->query('batch')) {
            $batch = explode(',', $request->query('batch'));

            $with = $batch;
        }

        return Status::with($with)->where('id', $id)
            ->first();
    }

    // public function showIntecations(Request $request, $id)
    // {
    //     return Client::with('interactions.user')
    //         ->where('id', $id)
    //         ->first();
    // }


    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $client = Client::create($request->all());

    //     return response()->json($client, 201);
    // }

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
