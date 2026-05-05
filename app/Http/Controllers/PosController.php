<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->where('stock', '>', 0);
        
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
        
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->get();
        $categories = Category::all();

        return view('pos.index', compact('products', 'categories'));
    }

    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string',
            'total_amount' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            // Create Transaction
            $transaction = Transaction::create([
                'user_id' => auth()->id(),
                'total_amount' => $validated['total_amount'],
                'payment_method' => $validated['payment_method'],
                'status' => 'completed',
            ]);

            // Process each item
            foreach ($validated['items'] as $item) {
                $product = Product::lockForUpdate()->find($item['id']);
                
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Insufficient stock for {$product->name}");
                }

                // Deduct stock
                $product->decrement('stock', $item['quantity']);

                // Create Transaction Detail
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'subtotal' => $product->price * $item['quantity'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaction completed successfully.',
                'transaction_id' => $transaction->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }
}
