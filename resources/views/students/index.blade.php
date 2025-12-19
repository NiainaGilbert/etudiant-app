@extends('layouts.app')

@section('title', __('Student List'))

@section('content')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e0e0e0;
    }

    .page-header h2 {
        color: #333;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-primary {
        padding: 0.75rem 1.5rem;
        border-radius: 4px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
        transition: all 0.3s;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        cursor: pointer;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .search-container {
        margin-bottom: 2rem;
    }

    .search-form {
        max-width: 400px;
    }

    .search-box {
        display: flex;
        position: relative;
    }

    .search-box input {
        flex: 1;
        padding: 0.75rem 1rem;
        border: 1px solid #ddd;
        border-radius: 4px 0 0 4px;
        font-size: 1rem;
    }

    .search-box input:focus {
        outline: none;
        border-color: #667eea;
    }

    .btn-search {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 0 1.5rem;
        border-radius: 0 4px 4px 0;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .table-responsive {
        overflow-x: auto;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .students-table {
        width: 100%;
        border-collapse: collapse;
    }

    .students-table th,
    .students-table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }

    .students-table th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #333;
    }

    .students-table tr:hover {
        background-color: #f8f9fa;
    }

    .actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-edit {
        color: #667eea;
        text-decoration: none;
        padding: 0.5rem;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    .btn-edit:hover {
        background-color: rgba(102, 126, 234, 0.1);
    }

    .btn-delete {
        color: #dc3545;
        background: none;
        border: none;
        padding: 0.5rem;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-delete:hover {
        background-color: rgba(220, 53, 69, 0.1);
    }

    .no-data {
        text-align: center;
        padding: 3rem;
        color: #666;
    }

    .no-data i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: #ccc;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }
    }
</style>

<div class="page-header">
    <h2><i class="fas fa-users"></i> {{ __('Student List') }}</h2>
    <a href="{{ route('students.create') }}" class="btn-primary">
        <i class="fas fa-user-plus"></i> {{ __('Add Student') }}
    </a>
</div>

<div class="search-container">
    <form method="GET" action="{{ route('students.index') }}" class="search-form">
        <div class="search-box">
            <input type="text" 
                   name="search" 
                   placeholder="{{ __('Search') }}" 
                   value="{{ $search ?? '' }}">
            <button type="submit" class="btn-search">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
</div>

@if($students->isEmpty())
    <div class="no-data">
        <i class="fas fa-user-slash"></i>
        <p>{{ __('No students found') }}</p>
    </div>
@else
    <div class="table-responsive">
        <table class="students-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __('First Name') }}</th>
                    <th>{{ __('Last Name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Phone') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->first_name }}</td>
                        <td>{{ $student->last_name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->phone ?? '-' }}</td>
                        <td class="actions">
                            <a href="{{ route('students.edit', $student) }}" 
                               class="btn-edit" 
                               title="{{ __('Edit') }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" 
                                  action="{{ route('students.destroy', $student) }}" 
                                  style="display: inline;"
                                  onsubmit="return confirm('{{ __('Are you sure you want to delete this student?') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" title="{{ __('Delete') }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection