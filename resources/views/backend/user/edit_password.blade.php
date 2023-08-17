@extends('backend.layouts.master')
@section('content')


 <div class="content-wrapper">
  
  <div class="content-header">
   <div class="container-fluid">
    <div class="row mb-2">
     <div class="col-sm-6">
      <h1 class="m-0">Manage Password</h1>
     </div>
     <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
       <li class="breadcrumb-item"><a href="#">Home</a></li>
       <li class="breadcrumb-item active">Password</li>
      </ol>
     </div>
    </div>
   </div>
  </div>

  <section class="content">
   <div class="container-fluid">
    <div class="row row justify-content-center">
     <div class="col-8">

      <div class="card">
       <div class="card-header">
        <h3>Update your password</h3>
       </div>
               
       <div class="card-body">
        <form method="POST" action="{{ route('password.update' )}}" id="myForm">
         @csrf
         <div class="form-row">


          <div class="form-group col-md-12">
           <label for="Current password">Current Pasword</label>
           <input type="password" name="current_password" id="current_password" class="form-control">
          </div>

          <div class="form-group col-md-12">
           <label for="New Pasword">New Pasword</label>
           <input type="password" name="new_password" id="new_password" class="form-control">
          </div>

          <div class="form-group col-md-12">
           <label for="Confirm Pasword">Again New Pasword</label>
           <input type="password" name="again_new_password" id="again_new_password" class="form-control">
          </div>

          <div class="form-group col-md-12">
           <input type="submit" value="Update"  class="btn btn-primary">
          </div>

         </div>
        </form>
       </div>

      </div>

     </div>
    </div>
   </div>  
  </section>
    
 </div>


  <script>
   $(function () {
     $('#myForm').validate({
     rules:{
      current_password: {
       required: true,
      },
      new_password: {
      required: true,
      minlength: 6
     },
      again_new_password: {
      required: true,
      equalTo : '#new_password'
     },
    },
    messages: {
     current_password: {
     required: "Please enter current password",
     },
     new_password: {
     required: "Please enter new password",
     minlength: "Your password must be at least 6 characters long",
     },
     again_new_password: {
      required: "Please enter confirm password",
      equalTo: "again password does not match",
     },
    },
      errorElement: 'span',
      errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
      }
     });
    });
  </script>


  @endsection