<x-layout>
<li class="nav-item">
            <a href="/manager-dashboard" class="nav-link">
              <p>
                Manager-Dashboard
              </p>  
            </a>
    </li>
    <li class="nav-item">
            <a href="/manage-usercontrol" class="nav-link">
              <p>
                Manager-User
              </p>  
            </a>
    </li>
            <li class="nav-item">
            <a href="/usertask" class="nav-link">
              <p>
                User-progress
              </p>
            </a>
    </li>
</x-layout>
<div class="content-wrapper">
<section class="content-header">
<div class="container-fluid">
<div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manger</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="users" class="table table-bordered table-hover"> 
                  <thead>
                    <tr>
                      
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th> 
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
            <!-- /.card -->
            </div>
        </div>
</section>
</div>

<x-footer />

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- ./wrapper -->

 <!-- edit-user -->
<div class="modal fade" id="modal-default">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Edit-user</h4>
                  <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                  >
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
        <div class="modal-body">
        <form action="/edit-manager-user" class="edit-user" id="edit-user" method="post">
        @csrf
        <input type="hidden" id="id" name="id" value="">

        <x-form-input type="text" id="name" name="name" value="" />
        <x-form-error name="name" /> 
        
        <x-form-input  type="email" id="email" name="email" value=""/>
        <x-form-error name="email" />

        <x-form-error name="role"/> 


          <x-form-input type="password" id="password" name="password" placeholder="password" />
          <x-form-error name="password" />

          <x-form-input type="password" id="password_confirmation" name="password_confirmation" placeholder="Retype-password" />
          <x-form-error name="password_confirmation" />

          <div class="row">
                  <div class="col-8">
                    <div class="icheck-primary">
                    </div>
                  </div>
                  <!-- /.col -->
                  <x-form-submit type="submit">
                    Save Changes
                  </x-form-submit>
                  <!-- /.col -->
                </div>
        </div>
      </form>
                </div>
                <div class="modal-footer justify-content-between " >
                 
                </div>
              </div>
            </div>
          </div>

<!-- Delete-user-->
          <div class="modal fade" id="delete-user">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Delete-user</h4>
                  <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                  >
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
        <div class="modal-body">
          <p>Are You sure you want to delete the user?</p>

        
          <div class="row">
                  <div class="col-8">
                    <div class="icheck-primary">
                    </div>
                  </div>
                  <!-- /.col -->
                   <button type="submit" class="deleter btn btn-primary" style="margin:4px">Yes</button>
                   <button type="button" class="btn btn-primary" data-dismiss="modal" style="margin:4px">No</button>
                </div>
        </div>
                </div>
                <div class="modal-footer justify-content-between " >
                 
                </div>
              </div>
            </div>
          </div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css"/>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
 
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- jQuery Validation Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>


<script>
$(document).ready(function(){
    
    
    $('#users').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            url: "{{ route('getmanagerUserdetails') }}",
            data: { _token: '{{csrf_token()}}' },
        },
        columns: [
         
            {data: 'name', name: 'Name'},
            {data: 'email', name: 'Email'},
            {data: 'role',name: 'Role'},
            {data:'action',name:'Action'},
        ]
    });

    $(document).on('click', '.edit-button', function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    $('#edit-user').trigger("reset");
    $.ajax({
      url: "{{ route('editDetails') }}",
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type:'POST',
      data: {
        id: id,
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {
        $('#name').val(response[0].name);
        $('#email').val(response[0].email);
        $('#role').val(response[0].role);
        $('#id').val(response[0].id);
        $('#modal-default').modal('show');
      }
    });
  });


    $.validator.addMethod("passwordrule", function(value, element, args) {
        // Regex to check for at least one lowercase letter, one uppercase letter, one digit, and one special character
        return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@.#$!%*?&])[A-Za-z\d@.#$!%*?&]{8,15}$/.test(value);
    }, "Password must contain at least one lowercase letter, one uppercase letter, one digit, and one special character.");
        $("#add-user").validate({
          rules: {
            name: {
              required: true,
            },
            email: {
              required: true,
              email: true, // Built-in rule for email format
            },
            role:{
              required:true,
            },
            password: {
              required: true,
              passwordrule:true,
            },
            password_confirmation: {
              required: true,
              //equalTo:"#password",

            },
          },
          messages: {
            name:{
              required:"Please enter a name",
            },
            email: {
              required: "Please enter your email address.",
              email: "Please enter a valid email address",
            },
            role:{
              required:"Please select your role",
            },
            password: {
              required: "Please provide a password.",
            },
            password_confirmation: {
              required: "Please provide confirm password.",
              equalTo:"Passwords are not the same"
            },
          },
        });

       /* $("#edit-user").validate({
          rules: {
            password: {
              required: true,
              passwordrule:true,
            },
            password_confirmation: {
              required: true,
              equalTo:"#password",

            },
          },
          messages: {
            password: {
              required: "Please provide a password.",
            },
            password_confirmation: {
              required: "Please provide confirm password.",
              equalTo:"Passwords are not the same"
            },
          },
        });*/
        const firstInput = document.getElementById('role');
        const secondInputDiv = document.getElementById('manager');
        $(document).on('click', '#role', function(e){
          if (this.value === 'user') {
            // Hide the second input field
            secondInputDiv.style.display = 'block';
          } else {
            // Show the second input field
            secondInputDiv.style.display = 'none';
          }
        });
});
</script>
<style>
      .error {
        color: red;
      }
    </style>
</body>
</html>