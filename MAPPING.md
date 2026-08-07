# Mapping Proyek Blogspot (Laravel)

Mapping ini menjelaskan alur aplikasi: **URL/Rute → Controller → Method → View → Model → Tabel**.

## 1. Struktur Direktori

```
app/
├── Http/
│   └── Controllers/
│       ├── AuthController.php          # Login & logout
│       ├── HomeController.php          # Halaman publik (beranda & detail artikel)
│       └── Admin/
│           ├── DashboardController.php # Statistik dashboard admin
│           ├── PostController.php      # CRUD artikel (admin)
│           └── CategoryController.php  # CRUD kategori (admin)
└── Models/
    ├── User.php
    ├── Post.php                        # Model artikel
    └── Category.php                    # Model kategori

database/migrations/
├── 0001_01_01_000000_create_users_table.php
├── 2026_08_07_000001_create_categories_table.php
├── 2026_08_07_000002_create_posts_table.php
└── 2026_08_07_000003_add_remember_token_to_users_table.php

resources/views/
├── layouts/app.blade.php               # Layout utama
├── home.blade.php                      # Beranda (publik)
├── post.blade.php                      # Detail artikel (publik)
├── auth/login.blade.php                # Halaman login
└── admin/
    ├── dashboard.blade.php
    ├── categories/index.blade.php
    └── posts/{index,create,edit}.blade.php
```

## 2. Mapping Rute

### Area Publik (tanpa login)

| Method | URL       | Nama Rute    | Controller       | Method      | View              |
|--------|-----------|--------------|------------------|-------------|-------------------|
| GET    | `/`       | `home`       | `HomeController` | `index`     | `home`            |
| GET    | `/post/{id}` | `post.show` | `HomeController` | `show`      | `post`            |
| GET    | `/login`  | `login`      | `AuthController` | `showLogin` | `auth.login`      |
| POST   | `/login`  | —            | `AuthController` | `login`     | redirect → dashboard |
| POST   | `/logout` | `logout`    | `AuthController` | `logout`    | redirect → login  |

### Area Admin (wajib login — middleware `auth`)

Prefix: `/admin`

| Method | URL                  | Nama Rute            | Controller        | Method      | View                          |
|--------|----------------------|----------------------|-------------------|-------------|-------------------------------|
| GET    | `/admin/`            | `admin.dashboard`    | `DashboardController` | `index`  | `admin.dashboard`             |
| GET    | `/admin/posts`       | `admin.posts.index`  | `PostController`  | `index`     | `admin.posts.index`           |
| GET    | `/admin/posts/create`| `admin.posts.create` | `PostController`  | `create`    | `admin.posts.create`          |
| POST   | `/admin/posts`       | `admin.posts.store`  | `PostController`  | `store`     | redirect → `admin.posts.index`|
| GET    | `/admin/posts/{post}/edit` | `admin.posts.edit` | `PostController` | `edit`  | `admin.posts.edit`            |
| PUT/PATCH | `/admin/posts/{post}` | `admin.posts.update` | `PostController` | `update`  | redirect → `admin.posts.index`|
| DELETE | `/admin/posts/{post}` | `admin.posts.destroy` | `PostController` | `destroy` | redirect → `admin.posts.index`|
| GET    | `/admin/categories`  | `admin.categories.index` | `CategoryController` | `index` | `admin.categories.index`   |
| POST   | `/admin/categories`  | `admin.categories.store` | `CategoryController` | `store` | redirect → index           |
| PUT/PATCH | `/admin/categories/{category}` | `admin.categories.update` | `CategoryController` | `update` | redirect → index |
| DELETE | `/admin/categories/{category}` | `admin.categories.destroy` | `CategoryController` | `destroy` | redirect → index |

## 3. Mapping Model & Tabel

### Tabel `categories`
| Kolom   | Tipe     | Keterangan          |
|---------|----------|---------------------|
| id      | bigint   | Primary key         |
| name    | string   | Nama kategori       |
| slug    | string   | Unique, auto dari nama |

**Model:** `Category` → `#[Fillable(['name', 'slug'])]`, `timestamps = false`
**Relasi:** `hasMany(Post::class)` (satu kategori punya banyak artikel)

### Tabel `posts`
| Kolom        | Tipe      | Keterangan                     |
|--------------|-----------|--------------------------------|
| id           | bigint    | Primary key                    |
| category_id  | foreignId | FK → categories.id (`nullOnDelete`, nullable) |
| title        | string    | Judul artikel                  |
| content      | text      | Isi artikel                    |
| created_at   | timestamp | Auto, `useCurrent()`           |

**Model:** `Post` → `#[Fillable(['title', 'content', 'category_id'])]`, `timestamps = false`
**Relasi:** `belongsTo(Category::class)` (satu artikel punya satu kategori)

### Tabel `users`
Kolom standar Laravel + `remember_token`.

## 4. Mapping Relasi

```
Category  1 ──────── * Post
             (hasMany)
             * ──────── 1 (belongsTo)
```

## 5. Ringkasan Alur

- **Publik** → `HomeController` (list semua post + detail per post).
- **Login** → `AuthController` (auth manual dengan kolom `name` & `password`).
- **Admin** → semua rute dibungkus middleware `auth`, prefix `/admin`:
  - `DashboardController` menampilkan jumlah post & kategori.
  - `PostController` & `CategoryController` menangani CRUD.
