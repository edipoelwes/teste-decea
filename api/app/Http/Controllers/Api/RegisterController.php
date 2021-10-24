<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Company, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Post(
 * tags={"Auth"},
 * path="/api/auth/register",
 * summary="Sign up",
 * description="Register",
 * @OA\RequestBody(
 *    required=true,
 *    description="Values for register",
 *    @OA\JsonContent(
 *       required={"email","password", "name", "document", "social_name", "alias_name", "document_company", "document_company_secondary"},
 *       @OA\Property(property="name", type="string", format="text", example="user1"),
 *       @OA\Property(property="document", type="string", format="text", example="03585965236"),
 *       @OA\Property(property="email", type="string", format="email", example="exemplo2@gmail.com"),
 *       @OA\Property(property="password", type="string", format="password", example="123456"),
 *       @OA\Property(property="social_name", type="string", format="text", example="Fundacao STDP LTDA"),
 *       @OA\Property(property="alias_name", type="string", format="text", example="Fundacao STDP"),
 *       @OA\Property(property="document_company", type="string", format="text", example="63565720000125"),
 *       @OA\Property(property="document_company_secondary", type="string", format="text", example="5066485-8"),
 *    ),
 * ),
 *  @OA\Response(
 *    response=401,
 *    description="Unauthorized",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, Unauthorized")
 *        )
 *     ),
 * @OA\Response(
 *    response=422,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
 *        )
 *     )
 * )
 */
class RegisterController extends Controller
{
    public function register(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = $request->only(['name', 'email', 'password', 'document', 'phone']);
            $company = $request->except(['name', 'email', 'password', 'document', 'phone']);
            $newCompany = Company::create($company);
            $user['company_id'] = $newCompany->id;
            $newUser = User::create($user);

            if ($newCompany && $newUser) {
                DB::commit();
                return response()->json('ok', 201);
            } else {
                DB::rollback();
                return response()->json('Unauthorized', 401);
            }
        } catch (\Throwable $th) {
            return response()->json('Error', 500);
        }
    }
}
