@extends('layouts.layout')
@section('content')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form action="{{url('add-student')}}" method="POST" name="registration" enctype="multipart/form-data" >
      
        @csrf
      <div class="modal-body">
            <div class="form-group mb-3">
                <label for="">Name</label>
                <input type="text" name="name" required class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="">Mobile</label>
                <input type="number" name="mobile" required class="form-control numeric">
            </div>
            <div class="form-group mb-3">
                <label for="">Email</label>
                <input type="email" name="email" required class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="">Address</label>
                <!-- <input type="text" name="address" required class="form-control"> -->
                <textarea name="address" rows="5" cols="20" required class="form-control"></textarea>

            </div>
            <div class="form-group mb-3">
                <label for="">Gender</label>
                <input type="radio" name="gender" value="male" required>Male
                <input type="radio" name="gender" value="female" required>Female

            </div>
            <div class="form-group mb-3">
                <label for="">Image</label>
                <input type="file" name="files" class="form-control-file" id="fileUpload" required>
            </div>
            <!-- <div id="fileContainer">
                <div class="mb-3">
                    <input type="file" name="files[]" class="form-control-file" id="fileUpload">
                    <button type="button" class="btn btn-primary" id="addFile">Add File</button>
                </div>
            </div> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
</form>
    </div>
  </div>
</div>
<!-- edit modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit & Update User Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form action="{{url('update-student')}}" method="POST"  enctype="multipart/form-data" >
        @csrf
        
        <input type="hidden" id="stud_id" name="stud_id">
      <div class="modal-body">
            <div class="form-group mb-3">
                <label for="">Full Name</label>
                <input type="text" name="name" id="name" required class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="">Mobile</label>
                <input type="number" name="mobile" id="mobile" required class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="">Email</label>
                <input type="email" name="email" id="email" required class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="">Address</label>
                <!-- <input type="text" name="address" id="address" required class="form-control"> -->
                <textarea name="address" rows="5" cols="20" id="address" required class="form-control"></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="">Gender</label>
                <input type="radio" name="gender" value="male" id="gender" required>Male
                <input type="radio" name="gender" value="female" id="gender" required>Female

            </div>
            <div class="form-group mb-3">
                <label for="">Image</label>
                <input type="file" name="files" class="form-control-file" id="fileUpload" required>
                
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
</form>
    </div>
  </div>
</div>
<!-- edit modal end -->
<!-- delete modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete User Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form action="{{url('delete-student')}}" method="POST">
        @csrf
        @method('DELETE')
        <h4>Confirm to delete data..?</h4>
        <input type="hidden" id="deleting_id" name="delete_stud_id">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Yes Delete</button>
      </div>
</form>
    </div>
  </div>
</div>
<!-- end delete modal -->
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            @if(session('status'))
            <div class="alert alert-success">{{session('status')}}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>
                        User Data
                        <button type="button" class="btn btn-primary float-end" data-toggle="modal" data-target="#exampleModal">Add User</a>
                    </h4>
                   

                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Image</th>

                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($student as $item)
                            
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->mobile}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->address}}</td>
                                <td>{{$item->gender}}</td>
                                <td><img src="/images/{{$item->image}}" width="100px"></td>

                                <td>
                                    <button type="button"  value="{{$item->id}}" class="btn btn-primary btn-sm editbtn">Edit</button>
                                </td>
                                <td>
                                    <button type="button"  value="{{$item->id}}" class="btn btn-danger btn-sm deletebtn">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $(document).on('click','.deletebtn',function(){
            var stud_id = $(this).val();
            alert(stud_id);
            $('#deleteModal').modal('show');
            $('#deleting_id').val(stud_id);
        });

        // $('#edit_btn').click(function(){
         $(document).on('click','.editbtn',function(){
            var stud_id = $(this).val();
            // alert(stud_id);
            $('#editModal').modal('show');
            $('#stud_id').val(stud_id);
            // alert(stud_id);
            $.ajax({
                type: "GET",
                url: "/edit-student/"+stud_id,
                success: function(response){
                    console.log(response);
                    $('#name').val(response.student.name);
                    $('#mobile').val(response.student.mobile);
                    $('#email').val(response.student.email);
                    $('#address').val(response.student.address);
                    $('input[name="gender"][value="' + response.student.gender + '"]').prop('checked', true);


                    $('#stud_id').val(stud_id);
                }
                
            });
        });
        
      
  
  $(document).ready(function() {
        $('form').submit(function(event) {
            event.preventDefault(); // Prevent form submission

            var file = $('#fileUpload').get(0).files[0]; // Get the selected file

            // Validate the file type and size
            if (file) {
                var fileType = file.type;
                var fileSize = file.size;

                // Define the allowed file types and maximum size
                var allowedTypes = ['image/jpeg', 'image/png','image/jpg'];
                var maxSize = 5242880; // 5MB

                // Perform the validation
                if (allowedTypes.indexOf(fileType) === -1) {
                    alert('Invalid file type. Please upload a JPEG, PNG, or jpg.');
                    return false;
                }

                if (fileSize > maxSize) {
                    alert('File size exceeds the maximum limit of 5MB.');
                    return false;
                }
            }

            // If the file is valid, submit the form
            this.submit();
        });
    });


    $(document).ready(function() {
    setTimeout(function() {
        $('#alert-success').fadeOut('fast');
    }, 5000); // 5000 milliseconds = 5 seconds
});

//    $('#add-btn').validate({
//       rules:{
//         name:{
//           required:true,
//           name:true,
//           minlength:4,
//           maxlength:6
//         },
//         mobile:{
//           required:true,
//           mobile:true,
//           minlength:10,
//           maxlength:10
//         },
//         email:{
//           required:true,
//           email:true
//          },
//         address:{
//           required:true,
//           address:true
//         },
//         files: {
//             required: true,
//             accept: "image/*,application/pdf"
//           }
        
//       },
//       messages:{
//         name:{
//                required:"Enter first name",
//                minlength:"Enter atleast 4 characters",
//                maxlength:"Enter no more than 6 characters"
//            },   
//         email:{
//           required:"Please enter your email",
//           email:"Please enter a valid email address"
//         },
//         mobile:{
//           required:"Please enter your phone number",
//           mobile:"Please enter a valid phone number"
//         },
//         files: {
//             required: "Please select a file",
//             accept: "Only image and PDF files are allowed"
//           },
//       },
//       submitHandler:function(form){
//         form.submit();
//       }
//     });
      
    });
</script>

@endsection