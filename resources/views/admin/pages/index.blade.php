@extends('layouts.admin')
@section('title','Pages Content')
@section('page-title','Page Content Manager')

@section('content')

<div class="pages-manager-layout">

    {{-- Left sidebar: page selector --}}
    <aside class="pages-sidebar">
        <p class="pages-sidebar-label">Select Page</p>
        <nav class="pages-nav">
            @foreach($pages as $p)
            <a href="/admin/pages/{{ $p->page_key }}/edit"
               class="pages-nav-link {{ isset($active) && $active === $p->page_key ? 'active' : '' }}">
                {{ $p->title_en ?? ucfirst($p->page_key) }}
            </a>
            @endforeach
        </nav>
    </aside>

    {{-- Right panel --}}
    <div class="pages-content-area">
        @if (!isset($page))
        <div class="pages-empty-state">
            <div style="font-size:3rem;margin-bottom:1rem;">📄</div>
            <h2>Select a page to edit</h2>
            <p>Choose any page from the left to manage its content.</p>
        </div>
        @else
            @include('admin.pages.form-inner')
        @endif
    </div>

</div>

@endsection
