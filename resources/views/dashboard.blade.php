@extends('layouts.app')

@section('title', __('Dashboard'))

@section('content')
<style>
    .dashboard-header {
        background-color: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .dashboard-header h2 {
        color: #333;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .dashboard-header p {
        color: #666;
    }

    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background-color: white;
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .stat-info h3 {
        font-size: 2rem;
        color: #333;
        margin-bottom: 0.25rem;
    }

    .stat-info p {
        color: #666;
    }

    .recent-students {
        background-color: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .section-header h3 {
        color: #333;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-view-all {
        background-color: #667eea;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background-color 0.3s;
    }

    .btn-view-all:hover {
        background-color: #5a6fd8;
    }

    .students-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .student-card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .student-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .student-avatar {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .student-info h4 {
        color: #333;
        margin-bottom: 0.5rem;
    }

    .student-info p {
        color: #666;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 5px;
        margin: 0.25rem 0;
    }

    .student-actions {
        margin-left: auto;
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

    .no-data {
        text-align: center;
        padding: 3rem;
        color: #666;
    }
</style>

<div class="dashboard-header">
    <h2><i class="fas fa-tachometer-alt"></i> {{ __('Welcome to Dashboard') }}</h2>
    <p>{{ __('Bonjour') }} {{ Auth::user()->username }}, {{ __('voici un aperçu de votre système') }}.</p>
</div>

<div class="dashboard-stats">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $totalStudents }}</h3>
            <p>{{ __('Total Students') }}</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-calendar-day"></i>
        </div>
        <div class="stat-info">
            <h3>{{ now()->format('d/m/Y') }}</h3>
            <p>{{ __('Date du jour') }}</p>
        </div>
    </div>
</div>

<div class="recent-students">
    <div class="section-header">
        <h3><i class="fas fa-history"></i> {{ __('Recent Students') }}</h3>
        <a href="{{ route('students.index') }}" class="btn-view-all">
            {{ __('View All') }} <i class="fas fa-arrow-right"></i>
        </a>
    </div>
    
    @if($recentStudents->isEmpty())
        <p class="no-data">{{ __('No students found') }}</p>
    @else
        <div class="students-grid">
            @foreach($recentStudents as $student)
                <div class="student-card">
                    <div class="student-avatar">
                        {{ $student->initials }}
                    </div>
                    <div class="student-info">
                        <h4>{{ $student->full_name }}</h4>
                        <p><i class="fas fa-envelope"></i> {{ $student->email }}</p>
                        @if($student->phone)
                            <p><i class="fas fa-phone"></i> {{ $student->phone }}</p>
                        @endif
                    </div>
                    <div class="student-actions">
                        <a href="{{ route('students.edit', $student) }}" class="btn-edit">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection