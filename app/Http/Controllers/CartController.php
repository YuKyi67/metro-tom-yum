<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // POST: /add-to-cart/{id}
    public function addToCart($id, Request $request)
    {
        try {
            $item = MenuItem::findOrFail($id);
            $quantity = (int) $request->input('quantity', 1);

            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += $quantity;
            } else {
                $cart[$id] = [
                    "name" => $item->name,
                    "quantity" => $quantity,
                    "price" => $item->price,
                    "imagePath" => $item->imagePath
                ];
            }

            session()->put('cart', $cart);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function viewCart()
    {
        return view('view-orders');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Item removed from cart.');
    }

    public function checkout(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Cart is empty.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $user = auth()->user();
        $description = 'Metro Tomyam Order - ' . now()->format('Y-m-d H:i:s');

        // Save to orders table
        $orderId = DB::table('orders')->insertGetId([
            'user_id' => $user->id,
            'items' => json_encode($cart),
            'total' => $total,
            'status' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = Http::asForm()->post('https://toyyibpay.com/index.php/api/createBill', [
            'userSecretKey'       => '47y0ve2h-pd3a-gcl1-m82c-a32m5swdi576',
            'categoryCode'        => 'galt9k44',
            'billName'            => 'Metro Tomyam Order',
            'billDescription'     => $description,
            'billPriceSetting'    => 1,
            'billPayorInfo'       => 1,
            'billAmount'          => $total * 100,
            'billReturnUrl'       => route('payment.success'),
            'billCallbackUrl'     => '',
            'billExternalReferenceNo' => 'ORDER-' . $orderId,
            'billTo'              => $user->name,
            'billEmail'           => $user->email,
            'billPhone'           => '0182217179'
        ]);

        $billCode = $response[0]['BillCode'] ?? null;

        if ($billCode) {
            session()->forget('cart');
            return redirect("https://toyyibpay.com/$billCode");
        } else {
            return back()->with('error', 'Failed to create payment. Please try again.');
        }
    }

    public function viewAllOrders()
    {
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name as customer_name', 'users.email')
            ->orderBy('orders.created_at', 'desc')
            ->get();

        return view('all-orders', ['orders' => $orders]);
    }

    public function orderHistory()
    {
        $user = Auth::user();
        $orders = DB::table('orders')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('order-history', compact('orders'));
    }
}
