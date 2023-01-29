<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class ProductsTest extends TestCase
{
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
        $user = User::first();

        $this->actingAs($user)
            ->get(route('products.create'))
            ->assertInertia(fn (
                AssertableInertia $inertia) => $inertia
                ->component('Products/Create')
                ->has('categories')
                ->has('currencies')
            );
    }
}
