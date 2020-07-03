<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\ProductRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Storage;
use Response;

class ProductController extends AppBaseController
{
  /** @var  ProductRepository */
  private $productRepository;

  public function __construct(ProductRepository $productRepo)
  {
    $this->productRepository = $productRepo;
  }

  /**
   * Display a listing of the Product.
   *
   * @param Request $request
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $products = $this->productRepository->all();

    return view('products.index')
      ->with('products', $products);
  }

  /**
   * Show the form for creating a new Product.
   *
   * @return Response
   */
  public function create()
  {
    return view('products.create');
  }

  /**
   * Store a newly created Product in storage.
   *
   * @param CreateProductRequest $request
   *
   * @return Response
   */
  public function store(CreateProductRequest $request)
  {
    $coverPath = $request->file('mainImagePath')->store('public/images');

    $input = $request->all();
    $pricedObject = [];
    $pricelessObject = [];

    // dd($request->request);

    // fill pricedObject
    $iterationCount = $request->request->get('pricedCount');
    for ($i = 0; $i < $iterationCount; $i++) {
      if ($request->request->get('pricedNormal')) {
        $pricedNormal = $request->request->get('pricedNormal');
        $pricedObject[$i]['normal'] = $pricedNormal[$i];
      }

      if ($request->request->get('pricedNested')) {
        $pricedNested = $request->request->get('pricedNested');
        $loopLength = count($pricedNested) / $iterationCount;
        $pricedObject[$i]['nested'] = [];

        for ($x = 0; $x < $loopLength; $x++) {
          array_push($pricedObject[$i]['nested'], $pricedNested[$x + $i * $loopLength]);
        }
      }

      if ($request->request->get('pricedOption')) {
        $pricedOption = $request->request->get('pricedOption');
        $pricedObject[$i]['option'] = $pricedOption[$i];
      }

      if ($request->request->get('pricedColor')) {
        $pricedColor = $request->request->get('pricedColor');
        $pricedObject[$i]['color'] = $pricedColor[$i];
      }
      $pricedObject[$i]['price'] = $request->request->get('price')[$i];
      $pricedObject[$i]['amount'] = $request->request->get('amount')[$i];
    }


    // fill pricelessObject
    if (count($request->request->get('price')) > $iterationCount) {
      if ($request->request->get('pricelessNormal')) {
        $pricelessNormal = $request->request->get('pricelessNormal');
        $pricelessObject['normal'] = $pricelessNormal;
      }

      if ($request->request->get('pricelessNested')) {
        $pricelessNested = $request->request->get('pricelessNested');
        $loopLength = count($pricelessNested);
        $pricelessObject['nested'] = [];

        for ($x = 0; $x < $loopLength; $x++) {
          array_push($pricelessObject['nested'], $pricelessNested[$x]);
        }
      }

      if ($request->request->get('pricelessOption')) {
        $pricelessOption = $request->request->get('pricelessOption');
        $pricelessObject['option'] = $pricelessOption;
      }

      if ($request->request->get('pricelessColor')) {
        $pricelessColor = $request->request->get('pricelessColor');
        $pricelessObject['color'] = $pricelessColor;
      }

      $prices = $request->request->get('price');
      $amounts = $request->request->get('amount');
      $pricelessObject['price'] = end($prices);
      $pricelessObject['amount'] = end($amounts);
    }

    // dd($pricedObject);
    // dd($pricelessObject);

    $input['priced'] = json_encode($pricedObject);
    $input['priceless'] = json_encode($pricelessObject);
    // dd($input);
    $product = $this->productRepository->create($input);
    $product->update(['mainImagePath' => Storage::url($coverPath)]);
    // $product->update(['priced' => json_encode($pricedObject)]);
    // $product->update(['priceless' => json_encode($pricelessObject)]);

    Flash::success('Product saved successfully.');

    return redirect(route('products.index'));
  }

  /**
   * Display the specified Product.
   *
   * @param int $id
   *
   * @return Response
   */
  public function show($id)
  {
    $product = $this->productRepository->find($id);

    if (empty($product)) {
      Flash::error('Product not found');

      return redirect(route('products.index'));
    }

    return view('products.show')->with('product', $product);
  }

  /**
   * Show the form for editing the specified Product.
   *
   * @param int $id
   *
   * @return Response
   */
  public function edit($id)
  {
    $product = $this->productRepository->find($id);

    if (empty($product)) {
      Flash::error('Product not found');

      return redirect(route('products.index'));
    }

    return view('products.edit')->with('product', $product);
  }

  /**
   * Update the specified Product in storage.
   *
   * @param int $id
   * @param UpdateProductRequest $request
   *
   * @return Response
   */
  public function update($id, UpdateProductRequest $request)
  {
    $product = $this->productRepository->find($id);

    if (empty($product)) {
      Flash::error('Product not found');

      return redirect(route('products.index'));
    }

    $product = $this->productRepository->update($request->all(), $id);

    Flash::success('Product updated successfully.');

    return redirect(route('products.index'));
  }

  /**
   * Remove the specified Product from storage.
   *
   * @param int $id
   *
   * @throws \Exception
   *
   * @return Response
   */
  public function destroy($id)
  {
    $product = $this->productRepository->find($id);

    if (empty($product)) {
      Flash::error('Product not found');

      return redirect(route('products.index'));
    }

    $this->productRepository->delete($id);

    Flash::success('Product deleted successfully.');

    return redirect(route('products.index'));
  }
}
