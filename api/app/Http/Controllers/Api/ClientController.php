<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request, $company)
  {
    $limit = $request->limit;
    $clients = Client::where('company_id', $company)->orderBy('id', 'desc')->paginate($limit);

    return response()->json($clients);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $client = Client::create($request->all());

    return response()->json($client, 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $client = Client::where('id', $id)->first();

    if(!$client) {
      return response()->json('cliente não encontrado');
    }

    return response()->json($client);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $client = Client::where('id', $id)->first();

    $client->update($request->all());

    return response()->json($client);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $client = Client::where('id', $id)->first();

    $client->delete();

    return response()->json($client);
  }
}
