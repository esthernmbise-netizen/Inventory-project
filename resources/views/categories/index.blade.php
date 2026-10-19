@extends('layouts.app')

@section('content')

<div class="categories-page">

    {{-- Page Header --}}
    <div class="categories-header">

        <div>
            <h1>Categories</h1>
            <p>Organize your products by category</p>
        </div>

        <a
            href="{{ route('categories.create') }}"
            class="btn add-category-btn"
        >
            + Add Category
        </a>

    </div>


    {{-- Category Cards --}}
    <div class="category-grid">

        @forelse($categories as $category)

            <div class="category-card">

                {{-- Card Top --}}
                <div class="category-card-top">

                    

                    <div class="category-actions">

                        <a
                            href="{{ route('categories.edit', $category) }}"
                            title="Edit category"
                            class="icon-btn"
                        ><svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
fill="currentColor" viewBox="0 0 24 24" >
<!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
<path d="M19.41 3c-.78-.78-2.05-.78-2.83 0l-2.09 2.09L12.7 3.3a.996.996 0 0 0-1.41 0l-6 6 1.41 1.41 5.29-5.29 1.09 1.09-8.79 8.78c-.13.13-.22.29-.26.46l-1 4c-.08.34.01.7.26.95.19.19.45.29.71.29.08 0 .16 0 .24-.03l4-1c.18-.04.34-.13.46-.26L20.99 7.41c.78-.78.78-2.05 0-2.83L19.4 2.99ZM7.48 18.1l-2.11.53.53-2.11 8.6-8.61 1.59 1.59-8.6 8.6ZM17.49 8.09 15.9 6.5l2.09-2.09 1.59 1.58-2.09 2.09Z"></path>
</svg>
                        </a>

                        <form
                            method="POST"
                            action="{{ route('categories.destroy', $category) }}"
                            onsubmit="return confirm('Delete this category?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                title="Delete category"
                                class="icon-btn delete-btn"
                                style="color:red;"
                            >
                                <svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
fill="currentColor" viewBox="0 0 24 24" >
<!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
<path d="M17 6V4c0-1.1-.9-2-2-2H9c-1.1 0-2 .9-2 2v2H2v2h2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8h2V6zM9 4h6v2H9zM6 20V8h12v12z"></path><path d="M9 10h2v8H9zm4 0h2v8h-2z"></path>
</svg>
                            </button>

                        </form>

                    </div>

                </div>


                {{-- Category Information --}}
                <div class="category-info">

                    <h2>
                        {{ $category->name }}
                    </h2>

                    <p class="category-description">
                        {{ $category->description ?: 'No description available.' }}
                    </p>

                </div>


                {{-- Card Footer --}}
                <div class="category-footer">

                    <span class="product-count">
                        Products
                    </span>

                    <a
                        href="{{ route('categories.show', $category) }}"
                        class="view-category"
                    >
                        View Products →
                    </a>

                </div>

            </div>

        @empty

            {{-- Empty State --}}
            <div class="empty-category">

                <div class="empty-icon">
                    📂
                </div>

                <h2>No categories yet</h2>

                <p>
                    Create your first category to start organizing your products.
                </p>

                <a
                    href="{{ route('categories.create') }}"
                    class="btn"
                >
                    + Add Category
                </a>

            </div>

        @endforelse

    </div>

</div>


{{-- Category Page Styling --}}
<style>

    .categories-page {
        width: 100%;
    }


    /* =========================
       PAGE HEADER
    ========================= */

    .categories-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .categories-header h1 {
        margin: 0;
        font-size: 30px;
        font-weight: 700;
    }

    .categories-header p {
        margin: 6px 0 0;
        color: #6b7280;
        font-size: 15px;
    }


    /* =========================
       ADD CATEGORY BUTTON
    ========================= */

    .add-category-btn {
        text-decoration: none;
        white-space: nowrap;
    }


    /* =========================
       CATEGORY GRID
    ========================= */

    .category-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 20px;
    }


    /* =========================
       CATEGORY CARD
    ========================= */

    .category-card {
        background: #ffffff;
        border: 1px solid #141d30;
        margin-top:7px;
        border-radius: 16px;
        padding: 22px;
        position:relative;

        min-height: 220px;

        display: flex;
        flex-direction: column;
        justify-content: space-between;

        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease,
            transform 0.2s ease;
    }


    .category-card:hover {
        border-color: #2563eb;
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.12);
        transform: translateY(-3px);
    }


    /* =========================
       CARD TOP
    ========================= */

    .category-card-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }


    /* =========================
       CATEGORY ICON
    =========================*/

    .category-icon {
        width: 52px;
        height: 52px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #eff6ff;
        border-radius: 14px;

        font-size: 25px;
    } 


    /* =========================
       ACTION BUTTONS
    ========================= */
.category-actions { position: absolute; top: 15px; right: 15px; display: flex; align-items: center; gap: 6px; }

    .category-actions form {
        margin-left:7px;
    }

    .icon-btn {
        width: 34px;
        height: 34px;

        display: fixed;
        align-items:left;
        justify-content: center;

        border: none;
        background: #f9fafb;
        position:relative;

        border-radius: 8px;

        cursor: pointer;
        text-decoration: none;

        transition: 0.2s ease;
    }

    .icon-btn:hover {
        background: #eff6ff;
    }

    .delete-btn:hover {
        background: #fee2e2;
        align-items:right;
    }


    /* =========================
       CATEGORY INFORMATION
    ========================= */

    .category-info {
        margin-top: 0px;
    }

    .category-info h2 {
        margin: 0 0 8px;

        font-size: 20px;
        font-weight: 650;

        color: #111827;
    }

    .category-description {
        margin: 0;

        color: #6b7280;

        font-size: 14px;
        line-height: 1.6;

        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }


    /* =========================
       CARD FOOTER
    ========================= */

    .category-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;

        margin-top: 20px;
        padding-top: 16px;

        border-top: 1px solid #449bf3;
    }

    .product-count {
        font-size: 19px;
        font-family:san-serif;
        color: #6b7280;
    }

    .view-category {
        color: #2563eb;
        text-decoration: none;

        font-size: 19px;
        font-weight: 600;

        transition: 0.2s ease;
    }

    .view-category:hover {
        color: #1d4ed8;
    }


    /* =========================
       EMPTY STATE
    ========================= */

    .empty-category {
        grid-column: 1 / -1;

        text-align: center;

        background: #ffffff;

        border: 1px dashed #d1d5db;
        border-radius: 16px;

        padding: 60px 20px;
    }

    .empty-icon {
        font-size: 45px;
        margin-bottom: 15px;
    }

    .empty-category h2 {
        margin: 0 0 8px;
        font-size: 20px;
    }

    .empty-category p {
        color: #6b7280;
        margin: 0 0 20px;
    }


    /* =========================
       TABLET
    ========================= */

    @media (max-width: 900px) {

        .category-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

    }


    /* =========================
       MOBILE
    ========================= */

    @media (max-width: 600px) {

        .categories-header {
            align-items: stretch;
        }

        .categories-header h1 {
            font-size: 25px;
        }

        .add-category-btn {
            width: 100%;
            text-align: center;
        }

        .category-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .category-card {
            padding: 18px;
        }

    }

</style>

@endsection

