
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookStore - Nhà sách trực tuyến</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #3659a2;
            --primary-light: #c9cbce;
            --accent: #f4a261;
        }
            
        .hero {
                position: relative;
                overflow: hidden;
                min-height: 380px;
                display: flex;
                align-items: center;
                border-radius: 22px;
                padding: 48px 35px;
                background-image: url('/images/banner-sach.png');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-image:
                    linear-gradient(
                        90deg,
                        rgba(255, 248, 235, 0.92) 0%,
                        rgba(255, 248, 235, 0.45) 45%,
                        rgba(255, 248, 235, 0.05) 100%
                    ),
                
            }

        .hero-label {
            color: #3659a2;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .hero h1 {
            font-size: clamp(30px, 4vw, 46px);
            font-weight: 800;
            line-height: 1.2;
            color: #283747;
        }

        @media (max-width: 576px) {
            .hero {
                min-height: 320px;
                padding: 32px 22px;
                background-position: center;
            }
        }


        body {
            background: #f7f8fc;
            color: #252b36;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: #fff;
        }

        .navbar-brand {
            color: var(--primary);
            font-weight: 800;
            font-size: 27px;
            letter-spacing: -.5px;
        }

        .search-box {
            max-width: 480px;
            width: 100%;
        }

        

        .hero-label {
            color: var(--primary);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .hero h1 {
            font-size: clamp(30px, 4vw, 46px);
            font-weight: 800;
            line-height: 1.2;
        }

        .section-title {
            font-size: 24px;
            font-weight: 800;
        }

        .category-item {
            background: #fff;
            color: #343a40;
            border: 1px solid #e2e5ec;
            border-radius: 30px;
            padding: 10px 18px;
            text-decoration: none;
            transition: .2s;
        }

        .category-item:hover {
            background: var(--primary);
            color: #fff;
        }

        .book-card {
            height: 100%;
            background: #fff;
            border: 1px solid #edf0f5;
            border-radius: 15px;
            overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(30, 50, 90, .10);
        }

        .book-cover {
            width: 100%;
            height: 235px;
            object-fit: contain;
            padding: 14px;
            background: #fff;
        }

        .book-title {
            min-height: 40px;
            font-size: 15px;
            line-height: 1.4;
            font-weight: 700;
        }

        .book-author {
            color: #777f8d;
            font-size: 13px;
        }

        .book-price {
            color: #dc3545;
            font-size: 18px;
            font-weight: 800;
        }

        .category-section {
            scroll-margin-top: 90px;
        }

        .btn-main {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .btn-main:hover {
            background: #294782;
            color: white;
        }

        footer {
            background: #fff;
            border-top: 1px solid #e8ebf1;
        }

        @media (max-width: 576px) {
            .hero {
                padding: 32px 22px;
            }

            .book-cover {
                height: 190px;
            }

            .section-title {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>

{{-- THANH ĐIỀU HƯỚNG --}}
<nav class="navbar navbar-expand-lg shadow-sm sticky-top py-3">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            BookStore<span class="text-warning">.</span>
        </a>

        <form class="d-flex mx-lg-auto my-3 my-lg-0 search-box"
              action="{{ route('home') }}"
              method="GET">

            <input
                class="form-control me-2"
                type="search"
                name="search"
                placeholder="Tìm tên sách bạn yêu thích..."
                value="{{ request('search') }}"
            >

            <button class="btn btn-main" type="submit">Tìm</button>
        </form>

        <a href="#" class="btn btn-outline-primary">
            Giỏ hàng
        </a>
    </div>
</nav>

<main class="container py-4">

            {{-- BANNER --}}
            <section class="hero mb-5">
                <div class="row align-items-center g-4 w-100">
                    <div class="col-lg-8">
                        <p class="hero-label mb-3">
                            Không gian dành cho người yêu sách
                        </p>

                        <h1>
                            Khám phá tri thức,<br>
                            mở ra thế giới mới.
                        </h1>

                        <p class="text-secondary mt-3 mb-4">
                            Tìm những cuốn sách truyền cảm hứng, phát triển bản thân
                            và đồng hành cùng bạn mỗi ngày.
                        </p>

                        <a href="#books" class="btn btn-main px-4 py-2">
                            Khám phá sách
                        </a>
                    </div>
                </div>
            </section>


    {{-- DANH MỤC --}}
    <section class="mb-5">
        
        {{-- BỘ LỌC VÀ SẮP XẾP --}}
        <section class="bg-white border rounded-4 p-3 p-md-4 mb-5">
            <form action="{{ route('home') }}" method="GET">
                <div class="row g-3 align-items-end">

                    {{-- Giữ lại từ khóa tìm kiếm --}}
                    <input
                        type="hidden"
                        name="search"
                        value="{{ request('search') }}"
                    >

                    {{-- Lọc danh mục --}}
                    <div class="col-md-5">
                        <label for="category_id" class="form-label fw-bold">
                            Lọc theo danh mục
                        </label>

                        <select
                            name="category_id"
                            id="category_id"
                            class="form-select"
                        >
                            <option value="">Tất cả danh mục</option>

                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    @selected(
                                        (string) $selectedCategoryId
                                        === (string) $category->id
                                    )
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Sắp xếp giá --}}
                    <div class="col-md-5">
                        <label for="sort" class="form-label fw-bold">
                            Sắp xếp sách
                        </label>

                        <select name="sort" id="sort" class="form-select">
                            <option
                                value="latest"
                                @selected($sort === 'latest')
                            >
                                Mới cập nhật
                            </option>

                            <option
                                value="price_asc"
                                @selected($sort === 'price_asc')
                            >
                                Giá từ thấp đến cao
                            </option>

                            <option
                                value="price_desc"
                                @selected($sort === 'price_desc')
                            >
                                Giá từ cao xuống thấp
                            </option>
                        </select>
                    </div>

                    {{-- Nút áp dụng --}}
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-main w-100">
                            Áp dụng
                        </button>
                    </div>

                </div>
            </form>

            {{-- Xóa điều kiện lọc --}}
            @if (
                request()->filled('category_id')
                || request()->filled('sort')
            )
                <div class="mt-3">
                    <a href="{{ route('home', [
                        'search' => request('search')
                    ]) }}" class="text-decoration-none">
                        Xóa bộ lọc
                    </a>
                </div>
            @endif
        </section>

        <h2 class="section-title mb-3">Danh mục sách</h2>

        <div class="d-flex flex-wrap gap-2">
            @forelse ($categories as $category)
                <a
                    href="{{ route('home', [
                        'category_id' => $category->id,
                        'sort' => $sort,
                        'search' => request('search')
                    ]) }}"
                    class="category-item"
                >
                    {{ $category->name }}
                </a>
            @empty
                <p class="text-secondary">
                    Chưa có danh mục sách.
                </p>
            @endforelse
        </div>
    </section>

    {{-- SÁCH THEO TỪNG DANH MỤC --}}
<section id="books">
    @forelse ($displayCategories as $category)
            @php
                $categoryBooks = $booksByCategory[$category->id]
                    ?? collect();
            @endphp

            <section class="category-section mb-5"
                     id="category-{{ $category->id }}">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <p class="text-primary small fw-bold mb-1">
                            BOOKSTORE COLLECTION
                        </p>

                        <h2 class="section-title mb-0">
                            {{ $category->name }}
                        </h2>
                    </div>

                    <span class="text-secondary small">
                        {{ $categoryBooks->count() }} sản phẩm
                    </span>
                </div>

                <div class="row g-3 g-md-4">
                    @forelse ($categoryBooks as $book)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="book-card">

                                @php
                                    $cover = $book->cover_image
                                    ? asset('images/books/' . $book->cover_image)
                                    : 'https://placehold.co/300x400/e9ecef/6c757d?text=BookStore';
                                @endphp

                                <img
                                src="{{ $cover }}"
                                alt="{{ $book->name }}"
                                class="card-img-top"
                                style="height: 260px; object-fit: contain;"
                            >

                                <div class="p-3">
                                    <h3 class="book-title">
                                        {{ $book->name }}
                                    </h3>

                                    <p class="book-author mb-2">
                                        {{ $book->author->name ?? 'Đang cập nhật tác giả' }}
                                    </p>

                                    <p class="book-price mb-3">
                                        {{ number_format((float) $book->price, 0, ',', '.') }} đ
                                    </p>

                                    <a
                                        href="{{ route('books.show', ['slug' => $book->slug]) }}"
                                        class="btn btn-outline-primary btn-sm w-100"
                                    >
                                        Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="bg-white border rounded-3 p-4 text-center">
                                <p class="mb-1">Chưa có sách trong danh mục này.</p>
                                <small class="text-secondary">
                                    Hãy thêm sách và chọn đúng danh mục trong cơ sở dữ liệu.
                                </small>
                            </div>
                        </div>
                    @endforelse
                </div>
            </section>
        @empty
            <div class="alert alert-info">
                Website chưa có danh mục sách nào.
            </div>
        @endforelse
    </section>

</main>

{{-- CHÂN TRANG --}}
<footer class="mt-5 py-4">
    <div class="container text-center">
        <a class="navbar-brand" href="{{ route('home') }}">
            BookStore.
        </a>

        <p class="text-secondary mt-2 mb-1">
            Nhà sách trực tuyến dành cho mọi độc giả.
        </p>

        <small class="text-secondary">
            Website phục vụ học tập môn Thương mại điện tử.
        </small>
    </div>
</footer>

</body>
</html>
