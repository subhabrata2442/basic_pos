@extends('layouts.admin')
@section('admin-content')
<style>
  .minus-btn {
    line-height: 40px;
    height: 40px;
    padding-top: 0;
    padding-bottom: 0;
}
  .plus-btn{
    line-height: 1.5;
  }
</style>
<div class="row">
  <div class="col-12">
    <form method="post" action="{{ route('admin.restaurant.table.edit', [base64_encode($data['floor']->id)]) }}" class="needs-validation" novalidate enctype="multipart/form-data">
      @csrf
      <div class="card">
        <div class="row">
          <x-alert />
          <div class="col-md-4">
            <div class="form-group">
              <label for="title" class="form-label">Floor/Room Name</label>
              <input type="text" class="form-control admin-input" id="title" name="title" value="{{ old('name', $data['floor']->title) }}" required autocomplete="off" placeholder="Enter Floor/Room Name">
              @error('title')
              <div class="error admin-error">{{ $message }}</div>
              @enderror 
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div id="add_table">
          @if(count($data['floor']->tables) > 0)
            @foreach ($data['floor']->tables as $key => $table)
            <input type="hidden" name="table_ids[]" value="{{$table->id}}">
            <div class="row add_table_sec" id="table_">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="table_name" class="form-label">Table Name</label>
                  <input type="text" class="form-control admin-input" id="table_name" name="table_names[{{$table->id}}]" value="{{$table->table_name}}" autocomplete="off" placeholder="Enter Table Name">
                </div>
              </div>
            </div>
            @endforeach
            
          @else
            <div class="row add_table_sec" id="table_1">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="table_name" class="form-label">Table Name</label>
                  <input type="text" class="form-control admin-input" id="table_name" name="table_names[]" value="" autocomplete="off" placeholder="Enter Table Name">
                </div>
              </div>
            </div>
          @endif
          {{-- <div class="row add_table_sec" >
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" class="form-control admin-input" id="title" name="title" value="{{ old('title') }}" required autocomplete="off">
                @error('title')
                <div class="error admin-error">{{ $message }}</div>
                @enderror 
              </div>
            </div>
            <div class="col-auto">
              <button class="btn btn-danger minus-btn" type="submit"><i class="fa fa-minus"></i></button>
            </div>
          </div> --}}
        </div>
        <div class="row">
          <div class="col-12">
            <a class="btn btn-success plus-btn" id="add_more_table">Add More</a>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="row">
          <div class="row">
            <div class="col-12">
              <button class="commonBtn-btnTag" type="submit">Submit </button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts') 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
<script>
$(document).on('click', '#add_more_table', function(){
  var count 	= $('#add_table .add_table_sec').length;
  var id		= count+1;

  var html = '';
  html += `<div class="row add_table_sec" id="table_`+id+`">
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" class="form-control admin-input" name="table_names[]" value="" placeholder="Enter Table Name">
              </div>
            </div>
            <div class="col-auto">
              <a class="btn btn-danger minus-btn" id="remove_table_`+id+`" onclick="remove_table_row(`+id+`);" data-id="`+id+`"><i class="fa fa-minus"></i></a>
            </div>
          </div>`;
  $("#add_table").append(html);
});

function remove_table_row(removeid){
  $("#table_"+removeid).remove();
}
</script> 
@endsection 