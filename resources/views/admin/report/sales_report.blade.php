@extends('layouts.admin')
@section('admin-content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <x-alert />
      <div class="m-list-search">
      <div class="row">
         <div class="col-lg-2 col-md-3 col-sm-12 mb-3">
              <a href="#" class="searchResultItem">
               <span class="itemIcon"><i class="far fa-image"></i></span>
               Balance Sheet Report</span>
              </a> 
         </div>
         <div class="col-lg-2 col-md-3 col-sm-12 mb-3">
              <a href="#" class="searchResultItem">
                <span class="itemIcon"><i class="far fa-image"></i></span>
                Sales Register
              </a> 
         </div>
         <div class="col-lg-2 col-md-3 col-sm-12 mb-3">
             <a href="#" class="searchResultItem">
               <span class="itemIcon"><i class="far fa-image"></i></span>
               Credit Note Register
            </a> 
         </div>
         <div class="col-lg-2 col-md-3 col-sm-12 mb-3">
              <a href="#" class="searchResultItem">
                <span class="itemIcon"><i class="far fa-image"></i></span>
                Purchase Register
              </a> 
         </div>
         <div class="col-lg-2 col-md-3 col-sm-12 mb-3">
                <a href="#" class="searchResultItem">
                  <span class="itemIcon"><i class="far fa-image"></i></span>
                  Debit Note Register
               </a> 
         </div>
         <div class="col-lg-2 col-md-3 col-sm-12 mb-3">
              <a href="#" class="searchResultItem">
                <span class="itemIcon"><i class="far fa-image"></i></span>
                Stock Register
               </a> 
         </div>
         <div class="col-lg-2 col-md-3 col-sm-12 mb-3">
              <a href="#" class="searchResultItem">
                <span class="itemIcon"><i class="far fa-image"></i></span>
                Customer Outstanding
               </a> 
         </div>
         <div class="col-lg-2 col-md-3 col-sm-12 mb-3">
              <a href="#" class="searchResultItem">
                <span class="itemIcon"><i class="far fa-image"></i></span>
                Supplier Outstanding
               </a> 
         </div>
         <div class="col-lg-2 col-md-3 col-sm-12 mb-3">
            <a href="#" class="searchResultItem">
               <span class="itemIcon"><i class="far fa-image"></i></span>
               Sales Tax Summary
             </a> 
         </div>
         <div class="col-lg-2 col-md-3 col-sm-12 mb-3">
              <a href="#" class="searchResultItem">
               <span class="itemIcon"><i class="far fa-image"></i></span>
               Credit Note Tax Summary
              </a> 
          </div>
         <div class="col-lg-2 col-md-3 col-sm-12 mb-3">
            <a href="#" class="searchResultItem">
               <span class="itemIcon"><i class="far fa-image"></i></span>
               Purchase Tax Summary
            </a> 
         </div>
         <div class="col-lg-2 col-md-3 col-sm-12 mb-3">
            <a href="#" class="searchResultItem">
              <span class="itemIcon"><i class="far fa-image"></i></span>
              Debit Note Tax Summary
            </a> 
         </div>
      </div>
      </div>


    </div>
  </div>
</div>
@endsection

@section('scripts') 
 
@endsection 