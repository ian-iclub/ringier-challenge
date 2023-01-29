<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $products = Product::with(['currency', 'category', 'media'])->orderBy('created_at', 'desc')->get();

        return Inertia::render('Products/Index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        $categories = Category::all();

        $currencies = Currency::all();

        return Inertia::render('Products/Create', [
            'categories' => $categories,
            'currencies' => $currencies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        # Create new product from request
        $new_product = [
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'description' => $request->input('description'),
            'date_online' => now(),
            'price' => $request->input('price'),
        ];

        # DB operations to save product
        try
        {
            # Set product
            $product = new Product($new_product);

            # Fetch category model
            $category = Category::find($request->input('category'));

            # Fetch currency model
            $currency = Currency::find($request->input('currency'));

            # Create relationships
            $product->user()->associate(Auth::user()->id);

            $product->category()->associate($category);

            $product->currency()->associate($currency);

            # Save model
            $product->save();

            $product->addMedia($request->file('image'))->toMediaCollection();

            # Set flash message
            $this->flash('success', 'Product saved successfully');

            return redirect()->route('products.index');
        }
        catch (Exception $exception)
        {
            Log::error($exception);

            # Set flash message
            $this->flash('danger', 'Error saving product, kindly try again');

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function show(Product $product): Response
    {
//        $category_products = $product->category->products->take(4)->each(function ($product){
//            return $product->load(['currency', 'category', 'media']);
//        });

        $category_products = $product->category->products()->with(['currency', 'category', 'media'])->take(4)->get();

        return Inertia::render('Products/Show', [
            'product' => $product->load(['currency', 'category', 'user', 'media']),
            'category_products' => $category_products
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function edit(Product $product): Response
    {
        return Inertia::render('Products/Edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        try
        {
            $product->delete();

            $this->flash('success', 'Product deleted successfully');

            return redirect()->route('products.index');
        }
        catch (Exception $exception)
        {
            Log::error($exception);

            $this->flash('danger', 'Error deleting product, kindly try again');

            return redirect()->back();
        }
    }
}
