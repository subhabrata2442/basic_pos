@extends('layouts.admin')
@section('admin-content')
    <div class="row">

        <div class="col-12">
            <div class="manage-role-type">
                <x-alert />
                <h3>Manage Role</h3>
                <ul class="d-flex justify-content-center">
                    @foreach ($data['role'] as $value)
                        <li class="@if ($value->id == $data['users']->role) active @endif">
                            <button type="button" class="manage-role-btn manage-role"
                                data-url="{{ route('admin.users.setRole', [$data['users']->id, $value->id]) }}">
                                <span class="manage-role-icon"><i class="{{ $value->icon }}"></i></span>{{ $value->name }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '.manage-role', function() {
            var url = $(this).data('url');
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to change role?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = url;
                }
            })
        })
    </script>
@endsection
