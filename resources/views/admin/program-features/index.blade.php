@extends('layouts.admin')
@section('title', 'Program Features')
@section('page-title', 'Accelerator — Program Features')

@section('content')
<div class="admin-panel">
    <div class="panel-header">
        <h2>{{ $items->count() }} feature{{ $items->count() === 1 ? '' : 's' }}</h2>
        <a href="/admin/program-features/create" class="btn btn-sm btn-primary">+ Add Feature</a>
    </div>
    <p style="color:#6b5b50;margin: 0 0 1rem;">These appear as a drop-down list on the public Accelerator page. Drag is not yet supported — use the Sort Order field to reorder.</p>
    <table class="data-table">
        <thead><tr><th>Order</th><th>Feature</th><th>Description preview</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse ($items as $f)
                <tr>
                    <td>{{ $f->sort_order }}</td>
                    <td><strong>{{ $f->name_en }}</strong><div style="color:#6b5b50;font-size:.85em;" dir="rtl">{{ $f->name_ar }}</div></td>
                    <td style="max-width:520px;color:#6b5b50;">{{ \Illuminate\Support\Str::limit(strip_tags($f->description_en), 110) }}</td>
                    <td class="actions-cell">
                        <a href="/admin/program-features/{{ $f->id }}/edit" class="btn btn-xs">Edit</a>
                        <form action="/admin/program-features/{{ $f->id }}" method="POST" class="inline" onsubmit="return confirm('Remove this feature?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="empty-state">No features yet. <a href="/admin/program-features/create">Add the first one →</a></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
