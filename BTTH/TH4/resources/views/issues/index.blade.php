@extends('layouts.app')

@section('content')
    <h1>Danh sách báo cáo</h1>
    <a href="{{ route('issues.create') }}" class="btn btn-primary mb-3">Thêm báo cáo</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Mã vấn đề</th>
                <th>Tên máy tính</th>
                <th>Tên phiên bản</th>
                <th>Người báo cáo</th>
                <th>Thời gian báo cáo</th>
                <th>Mức độ sự cố</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($issues as $issue)
                <tr>
                    <td>{{ $issue->id }}</td>
                    <td>{{ $issue->computer->computer_name }}</td>
                    <td>{{ $issue->computer->model }}</td>
                    <td>{{ $issue->reported_by }}</td>
                    <td>{{ $issue->reported_date }}</td>
                    <td>{{ $issue->urgency }}</td>
                    <td>{{ $issue->status }}</td>
                    <td>
                        <a href="{{ route('issues.show', $issue->id) }}" class="btn btn-info btn-sm">Xem</a>
                        <a href="{{ route('issues.edit', $issue->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('issues.destroy', $issue->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xác nhận xoá?')">Xoá</button>
                        </form>                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Hiển thị phân trang -->
    {{ $issues->links('pagination::bootstrap-5') }}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var issueId = button.getAttribute('data-id');
                var action = "{{ url('issues') }}/" + issueId;
                var form = deleteModal.querySelector('#deleteForm');
                form.action = action;
            });
        });
    </script>
@endsection