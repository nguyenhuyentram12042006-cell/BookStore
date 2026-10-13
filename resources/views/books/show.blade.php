
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $book->name }} - BookStore</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            background: #f7f8fc;
            color: #252b36;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: white;
        }

        .navbar-brand {
            color: #3659a2;
            font-size: 27px;
            font-weight: 800;
            text-decoration: none;
        }

        .detail-card {
            background: white;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 5px 25px rgba(30, 50, 90, .06);
        }

        .book-image {
            width: 100%;
            max-height: 480px;
            object-fit: contain;
        }

        .book-price {
            color: #dc3545;
            font-size: 30px;
            font-weight: 800;
        }

        .detail-label {
            color: #6c757d;
            min-width: 145px;
        }

        .btn-main {
            background: #3659a2;
            border-color: #3659a2;
            color: white;
        }

        .btn-main:hover {
            background: #294782;
            color: white;
        }

        .description {
            line-height: 1.8;
            white-space: pre-line;
        }

        @media (max-width: 576px) {
            .detail-card {
                padding: 18px;
            }

            .book-price {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar shadow-sm py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="{{ route('home') }}">
            BookStore<span class="text-warning">.</span>
        </a>

        <a href="{{ route('home') }}" class="btn btn-outline-primary">
            ← Về trang chủ
        </a>
    </div>
</nav>

<main class="container py-4 py-md-5">

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}">Trang chủ</a>
            </li>

            <li class="breadcrumb-item">
                {{ $book->category->name ?? 'Danh mục sách' }}
            </li>

            <li class="breadcrumb-item active" aria-current="page">
                {{ $book->name }}
            </li>
        </ol>
    </nav>

    <div class="detail-card">
        <div class="row g-4 g-lg-5">

            {{-- ẢNH BÌA --}}
            <div class="col-md-5 text-center">
                @php
                    $cover = $book->cover_image
                        ? asset('images/books/' . $book->cover_image)
                        : 'https://placehold.co/400x550/e9ecef/6c757d?text=BookStore';
                @endphp

                <img
                    src="{{ $cover }}"
                    alt="{{ $book->name }}"
                    class="book-image"
                >
            </div>

            {{-- THÔNG TIN SÁCH --}}
            <div class="col-md-7">

                <span class="badge text-bg-primary mb-3">
                    {{ $book->category->name ?? 'Sách' }}
                </span>

                <h1 class="fw-bold mb-3">
                    {{ $book->name }}
                </h1>

                <p class="text-secondary mb-3">
                    Tác giả:
                    <strong>
                        {{ $book->author->name ?? 'Đang cập nhật' }}
                    </strong>
                </p>

                <div class="book-price mb-3">
                    {{ number_format((float) $book->price, 0, ',', '.') }} đ
                </div>

                <p class="mb-4">
                    @if ($book->stock > 0)
                        <span class="text-success fw-semibold">
                            ● Còn hàng
                        </span>
                        <span class="text-secondary">
                            ({{ $book->stock }} cuốn)
                        </span>
                    @else
                        <span class="text-danger fw-semibold">
                            ● Hết hàng
                        </span>
                    @endif
                </p>

                <hr>

                <div class="d-flex mb-3">
                    <span class="detail-label">Nhà xuất bản:</span>
                    <span>{{ $book->publisher ?: 'Đang cập nhật' }}</span>
                </div>

                <div class="d-flex mb-3">
                    <span class="detail-label">Năm xuất bản:</span>
                    <span>{{ $book->publication_year ?: 'Đang cập nhật' }}</span>
                </div>

                <div class="d-flex mb-3">
                    <span class="detail-label">Mã ISBN:</span>
                    <span>{{ $book->isbn ?: 'Chưa cập nhật' }}</span>
                </div>

                <div class="d-flex mb-4">
                    <span class="detail-label">Danh mục:</span>
                    <span>{{ $book->category->name ?? 'Chưa phân loại' }}</span>
                </div>

                <a
                    href="{{ route('home') }}"
                    class="btn btn-outline-secondary px-4 py-2"
                >
                    Tiếp tục xem sách
                </a>

                {{-- Sẽ kết nối với chức năng giỏ hàng ở bước tiếp theo --}}
                <button
                    type="button"
                    class="btn btn-main px-4 py-2"
                    disabled
                    title="Chức năng giỏ hàng sẽ được tích hợp ở bước tiếp theo"
                >
                    Thêm vào giỏ hàng
                </button>

            </div>
        </div>

        {{-- MÔ TẢ SÁCH --}}
        <hr class="my-4 my-md-5">

        <h2 class="h4 fw-bold mb-3">Mô tả sách</h2>

        <div class="description text-secondary">
            {{ $book->description ?: 'Thông tin mô tả của cuốn sách đang được cập nhật.' }}
        </div>
    </div>

</main>

<footer class="bg-white border-top py-4 mt-4">
    <div class="container text-center">
        <p class="mb-1 fw-bold">BookStore</p>
        <small class="text-secondary">
            Nhà sách trực tuyến dành cho mọi độc giả.
        </small>
    </div>
</footer>

</body>
</html>
