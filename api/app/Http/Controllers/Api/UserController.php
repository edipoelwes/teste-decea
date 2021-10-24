<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{User};
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @OA\Get(
     * tags={"Users"},
     * path="/api/users/{company}",
     * summary="Users",
     * description="Retorna uma lista de usuarios",
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
     *       @OA\Property(property="id", type="string", example="2"),
     *       @OA\Property(property="company_id", type="string", example="2"),
     *       @OA\Property(property="name", type="string", example="user1"),
     *       @OA\Property(property="document", type="string", example="035.859.652-36"),
     *       @OA\Property(property="email", type="string", example="exemplo2@gmail.com"),
     *        )
     *     )
     * )
     */
    public function index($company)
    {
        $users = User::with('company')->where('company_id', $company)->get();

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create($request->all());

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('company')->where('id', $id)->first();

        return response()->json($user);
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
        $user = User::where('id', $id)->first();

        $user->update($request->all());

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();

        $user->delete();

        return response()->json();
    }
}
