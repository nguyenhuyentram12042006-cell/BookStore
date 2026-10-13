
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookStore - Nhà sách trực tuyến</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .navbar-brand {
            font-weight: 700;
            color: #0d6efd;
        }
        .hero {
            background: linear-gradient(135deg, #dbeafe, #eff6ff);
            border-radius: 16px;
            padding: 48px 28px;
        }
        .book-card {
            height: 100%;
            transition: transform .2s;
        }
        .book-card:hover {
            transform: translateY(-4px);
        }
        .book-cover {
            height: 220px;
            object-fit: contain;
            padding: 12px;
            background: #fff;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">BookStore</a>

        <form class="d-flex mx-auto" action="/" method="GET">
            <input class="form-control me-2"
                   type="search"
                   name="search"
                   placeholder="Tìm tên sách..."
                   value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Tìm</button>
        </form>

        <a href="#" class="btn btn-outline-primary">Giỏ hàng</a>
    </div>
</nav>

<main class="container py-4">
    <section class="hero mb-5">
        <h1 class="fw-bold">Chào mừng đến với BookStore</h1>
        <p class="lead">Khám phá những cuốn sách hay dành cho bạn.</p>
        <a href="#books" class="btn btn-primary">Khám phá sách</a>
    </section>

    <section class="mb-5">
        <h2 class="h4 fw-bold mb-3">Danh mục sách</h2>

        <div class="d-flex flex-wrap gap-2">
            @forelse ($categories as $category)
                <span class="badge text-bg-light border p-3">
                    {{ $category->name }}
                </span>
            @empty
                <p class="text-muted">
                    Chưa có danh mục. Hãy thêm danh mục sách vào hệ thống.
                </p>
            @endforelse
        </div>
    </section>

    <section id="books">
        <h2 class="h4 fw-bold mb-3">Sách mới nhất</h2>

        <div class="row g-4">
            @forelse ($books as $book)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card book-card shadow-sm">
                        @if ($book->cover_image)
                            <img
                                src="{{ asset('storage/' . $book->cover_image) }}"
                                class="card-img-top book-cover"
                                alt="{{ $book->name }}">
                        @else
                            <div class="book-cover d-flex align-items-center justify-content-center text-muted">
                                Chưa có ảnh bìa
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h3 class="h6 fw-bold">
                                {{ $book->name }}
                            </h3>

                            <p class="small text-muted mb-1">
                                Tác giả: {{ $book->author->name ?? 'Chưa cập nhật' }}
                            </p>

                            <p class="small text-muted">
                                {{ $book->category->name ?? 'Chưa phân loại' }}
                            </p>

                            <p class="text-danger fw-bold mt-auto">
                                {{ number_format((float) $book->price, 0, ',', '.') }} đ
                            </p>

                            <button class="btn btn-outline-primary btn-sm" disabled>
                                Xem chi tiết (sắp ra mắt)
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        Chưa có sách để hiển thị. Chúng ta sẽ thêm dữ liệu mẫu ở bước tiếp theo.
                    </div>
                </div>
            @endforelse
        </div>
    </section>
</main>

<footer class="bg-white border-top mt-5 py-4">
    <div class="container text-center text-muted">
        BookStore – Website bán sách phục vụ học tập môn Thương mại điện tử.
    </div>
</footer>

</body>
</html>
