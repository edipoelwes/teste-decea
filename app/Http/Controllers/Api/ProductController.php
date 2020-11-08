<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request, $company, $category)
  {
    $limit = $request->limit;
    $products = Product::where([
      ['company_id', $company],
      ['category', $category]
      ])->paginate($limit);

    return response()->json($products);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $product = Product::create($request->all());

    return response()->json($product);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $product = Product::where('id', $id)->first();

    if(!$product) {
      return response()->json('produto não encontrado');
    }

    return response()->json($product);
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
    $product = Product::where('id', $id)->first();

    $product->update($request->all());

    return response()->json($product);

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $product = Product::where('id', $id)->first();

    $product->delete();

    return response()->json();
  }
}
