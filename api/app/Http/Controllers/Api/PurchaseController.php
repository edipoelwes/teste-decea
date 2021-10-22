<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Product, Purchase, PurchaseProduct};
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request, $company)
  {
    $limit = $request->limit;
    $purchases = Purchase::with('purchase_products')
      ->where('company_id', $company)
      ->orderBy('id', 'desc')
      ->paginate($limit);

    return response()->json($purchases);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    DB::beginTransaction();
    $purchase = $request->except('items');
    $products = $request->only('items');
    $products = $products['items'];

    $purchase_id = Purchase::create($purchase);


    $datetime = $this->dateTime();

    for($i = 0; $i < count($products); $i++) {
      unset($products[$i]['id']);
      $products[$i]['purchase_id'] = $purchase_id->id;
      $products[$i]['company_id'] = $purchase_id->company_id;
      $products[$i]['created_at'] = $datetime;
      $products[$i]['updated_at'] = $datetime;
      $products[$i]['product_id'] = intval($products[$i]['product_id']);
      $products[$i]['amount'] = intval($products[$i]['amount']);
      $products[$i]['sub_total'] = floatval($this->convertStringToDouble($products[$i]['sub_total']));

    }

    foreach($products as $item) {
      $product = Product::find($item['product_id']);
      $product->amount = $product->amount + $item['amount'];
      $product->save();
    }

    $purchase_product = PurchaseProduct::insert($products);

    if ($purchase_id && $purchase_product) {
      DB::commit();
      return response()->json([$purchase, 'purchase_products' => $products]);
    } else {
      DB::rollBack();
      return response()->json('Unauthorized', 401);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
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
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      //
  }

  private function dateTime()
  {
    $now = new DateTime();
    return $now->format('Y-m-d H:i:s');
  }

  private function convertStringToDouble(?string $param)
  {
    if (empty($param)) {
      return null;
    }

    return str_replace(',', '.', str_replace('.', '', $param));
  }
}
