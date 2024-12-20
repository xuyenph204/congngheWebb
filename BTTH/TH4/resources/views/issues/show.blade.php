@extends('layouts.app')

@section('content')
    <h1>Chi tiết báo cáo</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID Báo cáo: {{ $issue->id }}</h5>
            <p class="card-text"><strong>Tên máy tính:</strong> {{ $issue->computer->computer_name }}</p>
            <p class="card-text"><strong>Model:</strong> {{ $issue->computer->model }}</p>
            <p class="card-text"><strong>Ngừoi baso cáo:</strong> {{ $issue->reported_by }}</p>
            <p class="card-text"><strong>Ngày báo cáo:</strong> {{ $issue->reported_date }}</p>
            <p class="card-text"><strong>Mô tả:</strong> {{ $issue->description }}</p>
            <p class="card-text"><strong>Mức độ sự cố:</strong> {{ $issue->urgency }}</p>
            <p class="card-text"><strong>Trạng thái:</strong> {{ $issue->status }}</p>
            <a href="{{ route('issues.index') }}" class="btn btn-primary">Quay lại</a>
        </div>
    </div>
@endsection