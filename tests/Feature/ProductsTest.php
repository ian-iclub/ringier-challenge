<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    /**
     * Create variables to re-use
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::inRandomOrder()->first();

        $this->product = Product::inRandomOrder()->first();

        $this->category = Category::inRandomOrder()->first();

        $this->currency = Currency::inRandomOrder()->first();
    }

    /**
     * Test listings page
     *
     * @return void
     */
    public function test_index(): void
    {
        $this->get(route('products.index'))
            ->assertInertia(fn (
                AssertableInertia $inertia) => $inertia
                ->component('Products/Index')
                ->has('products')
            );
    }

    /**
     * Test create a listing page
     *
     * @return void
     */
    public function test_create(): void
    {
        $this->actingAs($this->user)
            ->get(route('products.create'))
            ->assertInertia(fn (
                AssertableInertia $inertia) => $inertia
                ->component('Products/Create')
                ->has('categories')
                ->has('currencies')
            );
    }


    /**
     * Test listing creation
     *
     * @return void
     */
    public function test_store(): void
    {
        $title = fake()->sentence(3);

        $request = [
            'image' => UploadedFile::fake()->image('test.jpg'),
            'title' => fake()->sentence(3),
            'slug' => Str::slug($title),
            'description' => fake()->sentence(10),
            'date_online' => now(),
            'price' => fake()->numberBetween(1, 300000),
            'category' => $this->category->id,
            'currency' => $this->currency->id
        ];

        $this->actingAs($this->user)
            ->post(route('products.store'), $request)
            ->assertRedirect(route('products.index'));

        $this->assertModelExists(Product::whereTitle($request['title'])->first());
    }

    /**
     * Test single listing page
     *
     * @return void
     */
    public function test_show(): void
    {
        $this->get(route('products.show', $this->product))
            ->assertInertia(fn (
                AssertableInertia $inertia) => $inertia
                ->component('Products/Show')
                ->has('product')
                ->has('category_products')
            );
    }

    /**
     * Test delete listing
     *
     * @return void
     */
    public function test_destroy(): void
    {
        $product = $this->product;

        $this->actingAs($this->user)
            ->delete(route('products.destroy', $product))
            ->assertRedirect(route('products.index'));

        $this->assertModelMissing($product);
    }
}
