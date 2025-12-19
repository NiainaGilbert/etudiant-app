@extends('layouts.app')

@section('title', __('Edit Student'))

@section('content')
@include('students.styles')

<div class="page-header">
    <h2><i class="fas fa-edit"></i> {{ __('Edit Student') }}</h2>
    <a href="{{ route('students.index') }}" class="btn-secondary">
        <i class="fas fa-arrow-left"></i> {{ __('Cancel') }}
    </a>
</div>

<div class="form-container">
    <form method="POST" action="{{ route('students.update', $student) }}" class="student-form">
        @csrf
        @method('PUT')
        
        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="form-row">
            <div class="form-group">
                <label for="first_name">{{ __('First Name') }} *</label>
                <input type="text" 
                       id="first_name" 
                       name="first_name" 
                       value="{{ old('first_name', $student->first_name) }}"
                       required 
                       maxlength="50">
            </div>
            
            <div class="form-group">
                <label for="last_name">{{ __('Last Name') }} *</label>
                <input type="text" 
                       id="last_name" 
                       name="last_name" 
                       value="{{ old('last_name', $student->last_name) }}"
                       required 
                       maxlength="50">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="email">{{ __('Email') }} *</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', $student->email) }}"
                       required 
                       maxlength="100">
            </div>
            
            <div class="form-group">
                <label for="phone">{{ __('Phone') }}</label>
                <input type="tel" 
                       id="phone" 
                       name="phone" 
                       value="{{ old('phone', $student->phone) }}"
                       maxlength="20">
            </div>
        </div>
        
        <div class="form-group">
            <label for="birth_date">{{ __('Birth Date') }}</label>
            <input type="date" 
                   id="birth_date" 
                   name="birth_date"
                   value="{{ old('birth_date', $student->birth_date?->format('Y-m-d')) }}">
        </div>
        
        <div class="form-group">
            <label for="address">{{ __('Address') }}</label>
            <textarea id="address" 
                      name="address" 
                      rows="3" 
                      maxlength="500">{{ old('address', $student->address) }}</textarea>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> {{ __('Save') }}
            </button>
            <a href="{{ route('students.index') }}" class="btn-secondary">
                <i class="fas fa-times"></i> {{ __('Cancel') }}
            </a>
        </div>
    </form>
</div>
@endsection