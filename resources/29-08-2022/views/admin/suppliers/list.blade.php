@extends('layouts.admin')
@section('admin-content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <x-alert />
      <div class="table-responsive dataTable-design">
        <table id="Supplier_table" class="table table-bordered">
          <thead>
          <th>Company Name</th>
            <th>Name</th>
            <th>Email</th>
            <th>State</th>
            <th>PAN</th>
            <th>Address</th>
            <th>Area</th>
            <th>City</th>
            <th>Zip Code</th>
            <th>Actions</th>
              </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts') 
<script type="text/javascript">
        $(function() {

            var table = $('#Supplier_table').DataTable({
                processing: true,
                serverSide: true,
                searchDelay: 350,
                ajax: "{{ route('admin.supplier.list') }}",
                columns: [{
                        data: 'company_name',
                        name: 'company_name',
                    },
                    {
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
					{
                        data: 'state',
                        name: 'state',
                    },
                    {
                        data: 'pan',
                        name: 'pan',
                    },
					{
                        data: 'address',
                        name: 'address',
                    },
					{
                        data: 'area',
                        name: 'area',
                    },
					{
                        data: 'city',
                        name: 'city',
                    },
					{
                        data: 'pin',
                        name: 'pin',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });

        $(document).on('click', '#delete_supplier', function() {
            var url = $(this).data('url');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    window.location = url;
                }
            })
        });
    </script> 
@endsection 