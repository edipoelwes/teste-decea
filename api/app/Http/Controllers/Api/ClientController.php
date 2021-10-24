<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * @OA\Get(
     * tags={"Clients"},
     * path="/api/clients/{company}",
     * summary="lista de clientes",
     * description="Retorna uma lista de clientes",
     * security={{"bearer":{}}},
     *  @OA\Parameter(
     *    description="ID of company",
     *    in="path",
     *    name="company",
     *    required=true,
     *    example="1",
     *    @OA\Schema(
     *       type="integer",
     *       format="int64"
     *    )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="",
     *    @OA\JsonContent(
     *       @OA\Property(property="id", type="string", example="1"),
     *       @OA\Property(property="company_id", type="string", example="1"),
     *       @OA\Property(property="name", type="string", example="Ciara Bogisich"),
     *       @OA\Property(property="document", type="string", example="684.340.455-47"),
     *       @OA\Property(property="phone", type="string", example="(86) 99222 - 6108"),
     *        )
     *     )
     * )
     */
    public function index(Request $request, $company)
    {
        $limit = $request->limit;
        $clients = Client::where('company_id', $company)->orderBy('id', 'desc')->paginate($limit);

        return response()->json($clients);
    }


    /**
     * @OA\Post(
     * tags={"Clients"},
     * path="/api/clients",
     * summary="Inserir um cliente",
     * description="Insert um cliente em uma company",
     * security={{"bearer":{}}},
     * @OA\RequestBody(
     *    required=true,
     *    description="client credentials",
     *    @OA\JsonContent(
     *       required={"company_id","name"},
     *       @OA\Property(property="company_id", type="string", format="text", example="1"),
     *       @OA\Property(property="name", type="string", format="text", example="Edipo Elwes"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Cliente cadastrado com sucesso!")
     *        )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $client = Client::create($request->all());

        return response()->json($client, 201);
    }

    /**
     * @OA\Get(
     * tags={"Clients"},
     * path="/api/client/{company}",
     * summary="cliente",
     * description="Retorna um cliente",
     * security={{"bearer":{}}},
     *  @OA\Parameter(
     *    description="ID of company",
     *    in="path",
     *    name="company",
     *    required=true,
     *    example="1",
     *    @OA\Schema(
     *       type="integer",
     *       format="int64"
     *    )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="",
     *    @OA\JsonContent(
     *       @OA\Property(property="id", type="string", example="1"),
     *       @OA\Property(property="company_id", type="string", example="1"),
     *       @OA\Property(property="name", type="string", example="Ciara Bogisich"),
     *       @OA\Property(property="document", type="string", example="684.340.455-47"),
     *       @OA\Property(property="phone", type="string", example="(86) 99222 - 6108"),
     *        )
     *     )
     * )
     */
    public function show($id)
    {
        $client = Client::where('id', $id)->first();

        if (!$client) {
            return response()->json('cliente não encontrado');
        }

        return response()->json($client);
    }

    /**
     * @OA\Put(
     * tags={"Clients"},
     * path="/api/clients/{client}",
     * summary="Edita um cliente",
     * description="Edita um cliente",
     * security={{"bearer":{}}},
     * @OA\Parameter(
     *    name="client",
     *    description="Project id",
     *    required=true,
     *    in="path",
     *    @OA\Schema(
     *        type="integer",
     *        format="int64"
     *      )
     *    ),
     * @OA\RequestBody(
     *    required=true,
     *    description="client credentials",
     *    @OA\JsonContent(
     *       required={"company_id","name"},
     *       @OA\Property(property="company_id", type="string", format="text", example="1"),
     *       @OA\Property(property="name", type="string", format="text", example="Edipo Elwes"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Cliente editado com sucesso!")
     *        )
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $client = Client::where('id', $id)->first();

        $client->update($request->all());

        return response()->json($client);
    }

    /**
     * @OA\Delete(
     * tags={"Clients"},
     * path="/api/clients/{client}",
     * summary="remove um cliente",
     * description="Remove um cliente de uma company",
     * security={{"bearer":{}}},
     * @OA\Parameter(
     *    description="ID Cliente",
     *    in="path",
     *    name="client",
     *    required=true,
     *    example="1",
     *    @OA\Schema(
     *       type="integer",
     *       format="int64"
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Cliente removido com sucesso!")
     *        )
     *     )
     * )
     */
    public function destroy($id)
    {

        $client = Client::where('id', $id)->first();

        $client->delete();

        return response()->json($client);
    }
}
