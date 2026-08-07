<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('products.index', [
            'products' => Product::orderBy('name')->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        Product::create($validated);

        return redirect()->route('products.index')->with('status', __('app.saved'));
    }

    public function edit(Product $product): View
    {
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $this->validated($request, $product);

        $product->update($validated);

        return redirect()->route('products.index')->with('status', __('app.saved'));
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index')->with('status', __('app.deleted'));
    }

    private function validated(Request $request, ?Product $product = null): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:100', 'unique:products,sku,'.($product?->id)],
            'description' => ['nullable', 'string'],
            'unit' => ['required', 'string', 'max:50'],
            'unit_price' => ['required', 'numeric', 'min:0'],
            'quantity_on_hand' => ['required', 'integer', 'min:0'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
