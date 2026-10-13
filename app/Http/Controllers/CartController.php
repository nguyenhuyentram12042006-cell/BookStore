
<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    // Xem giỏ hàng
    public function index(Request $request): View
    {
        $cart = $request->session()->get('cart', []);

        $books = Book::whereIn('id', array_keys($cart))->get();

        $items = [];
        $total = 0;

        foreach ($books as $book) {
            $quantity = (int) $cart[$book->id];
            $subtotal = (float) $book->price * $quantity;

            $items[] = [
                'book' => $book,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ];

            $total += $subtotal;
        }

        return view('cart.index', compact('items', 'total'));
    }   

    // Thêm sách vào giỏ hàng
    public function add(Request $request, Book $book): RedirectResponse
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if (!$book->is_active || $book->stock < 1) {
            return back()->with('error', 'Sách hiện không có sẵn.');
        }

        $cart = $request->session()->get('cart', []);

        $currentQuantity = (int) ($cart[$book->id] ?? 0);
        $newQuantity = $currentQuantity + (int) $data['quantity'];

        if ($newQuantity > $book->stock) {
            return back()->with(
                'error',
                'Số lượng vượt quá tồn kho hiện tại.'
            );
        }

        $cart[$book->id] = $newQuantity;

        $request->session()->put('cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Đã thêm sách vào giỏ hàng.');
    }

    // Cập nhật số lượng
    public function update(Request $request, Book $book): RedirectResponse
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = $request->session()->get('cart', []);

        if (!array_key_exists($book->id, $cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Sách không có trong giỏ hàng.');
        }

        if (!$book->is_active || (int) $data['quantity'] > $book->stock) {
            return back()->with(
                'error',
                'Số lượng không hợp lệ hoặc vượt quá tồn kho.'
            );
        }

        $cart[$book->id] = (int) $data['quantity'];

        $request->session()->put('cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Đã cập nhật giỏ hàng.');
    }

    // Xóa sách khỏi giỏ hàng
    public function remove(Request $request, Book $book): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        unset($cart[$book->id]);

        $request->session()->put('cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Đã xóa sách khỏi giỏ hàng.');
    }
}
