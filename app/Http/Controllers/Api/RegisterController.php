<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Company, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
  public function register(Request $request)
  {
    DB::beginTransaction();
    $user = $request->only(['name', 'email', 'password']);
    $company = $request->only([
    'social_name',
    'alias_name',
    'document_company',
    'document_company_secondary',]);

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
  }
}
