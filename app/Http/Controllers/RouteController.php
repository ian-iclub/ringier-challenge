<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;

class RouteController extends Controller
{
    /**
     * Route to the index page
     *
     * @return Response
     */
    public function index(): Response
    {
        $products = Product::latest()->take(5)->get();

        $categories = Category::all();

        return Inertia::render('Index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    /**
     * Route to the dashboard to view personal listings
     *
     * @return Response
     */
    public function dashboard(): Response
    {
        return Inertia::render('Dashboard');
    }
}
