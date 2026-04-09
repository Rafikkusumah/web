@extends('layouts.admin')

@section('page-title', 'Edit Invoice')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <p class="text-gray-600 mb-4">Edit functionality similar to create. Copy from create.blade.php and pre-fill with data.</p>
    <a href="{{ route('admin.invoices.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Back to List</a>
</div>
@endsection
