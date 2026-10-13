<?php

namespace App\Http\Controllers;


use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        // Lấy các danh mục đang hoạt động
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        // Đọc danh mục được chọn từ URL
        $selectedCategoryId = $request->query('category_id', '');

        // Chỉ chấp nhận ID của danh mục đang hoạt động
        if (
            $selectedCategoryId !== ''
            && (
                !is_numeric($selectedCategoryId)
                || !$categories->contains(
                    'id',
                    (int) $selectedCategoryId
                )
            )
        ) {
            $selectedCategoryId = '';
        }

        // Chọn danh mục cần hiển thị
        if ($selectedCategoryId !== '') {
            $displayCategories = $categories->where(
                'id',
                (int) $selectedCategoryId
            );
        } else {
            $displayCategories = $categories;
        }

        // Chỉ chấp nhận các kiểu sắp xếp hợp lệ
        $sort = $request->query('sort', 'latest');

        if (!in_array($sort, [
            'latest',
            'price_asc',
            'price_desc'
        ], true)) {
            $sort = 'latest';
        }

        $booksByCategory = [];

        foreach ($displayCategories as $category) {
            $query = Book::with(['author', 'category'])
                ->where('is_active', true)
                ->where('category_id', $category->id);

            // Tìm theo tên sách
            if ($request->filled('search')) {
                $query->where(
                    'name',
                    'like',
                    '%' . $request->input('search') . '%'
                );
            }

            // Sắp xếp sách
            if ($sort === 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            } else {
                $query->latest();
            }

            // Giữ cách hiển thị tối đa 4 sách mỗi danh mục
            $booksByCategory[$category->id] = $query
                ->take(4)
                ->get();
        }

        return view('home', compact(
            'categories',
            'displayCategories',
            'booksByCategory',
            'selectedCategoryId',
            'sort'
        ));
    }
}