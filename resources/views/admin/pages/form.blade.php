@extends('layouts.admin')
@section('title','Edit Page')
@section('page-title','Page Content Manager')
@section('content')
<div class="pages-manager-layout">
    <aside class="pages-sidebar">
        <p class="pages-sidebar-label">Select Page</p>
        <nav class="pages-nav">
            @foreach($pages as $p)
            <a href="/admin/pages/{{ $p->page_key }}/edit"
               class="pages-nav-link {{ $p->page_key === $page->page_key ? 'active' : '' }}">
                {{ $p->title_en ?? ucfirst($p->page_key) }}
            </a>
            @endforeach
        </nav>
    </aside>
    <div class="pages-content-area">
        @include('admin.pages.form-inner')
    </div>
</div>
@endsection
