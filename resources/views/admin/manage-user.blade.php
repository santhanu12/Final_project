<x-layout>
    <li class="nav-item">
            <a href="/manage-user" class="nav-link">
              <p>
                Manage-Users
              </p>  
            </a>
    </li>
    <li class="nav-item">
            <a href="/manage-task" class="nav-link">
              <p>
                Manage-Tasks
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
                <h3 class="card-title">Users</h3>
                <h3 class="card-title-left" style="margin-left:830px"> <button type='submit' class='btn btn-default add-button'  data-toggle='modal' data-target='#modal-add-user'>Add-user</button></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="users" class="table table-bordered table-hover"> 
                  <thead>
                    <tr>
                      
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th> 
                      <th>Manager</th>
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
<div class="modal fade" id="modal-edit-user">
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
        <form action="/edit-user" class="edit-user" id="edit-user" method="post">
        @csrf
        <input type="hidden" id="id" name="id" value="">

        <x-form-input type="text" id="name" name="name" value="" />
        <x-form-error name="name" /> 
        
        <x-form-input  type="email" id="email" name="email" value=""/>
        <x-form-error name="email" />

        <label for="role">Choose a role</label>
        <select id="role" name="role">
            <option value="manager">Manager</option>
            <option value="user">User</option>
        </select>
        <x-form-error name="role"/> 

        <div id="manager" >
            <label for="manager">Choose a manager</label>
              <select id="options" name="manager" class="manager">
                        <option value=""></option>
              </select>
            <x-form-error name="manager"/> 
        </div>

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


           <!-- add-user -->
          <div class="modal fade" id="modal-add-user">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add-user</h4>
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
                <form action="/add-user" method="post" id="add-user">
                @csrf

                <input type="hidden" id="admin_id" name="admin_id" value="">
                <x-form-input type="text" id="name" name="name"  placeholder="Full name" />
                <x-form-error name="name" /> 
                
                <x-form-input  type="email" id="email" name="email"  placeholder="Email"/>
                <x-form-error name="email" />
                <label for="role">Choose a role</label>
                 <select id="role" name="role">
                    <option value="manager">Manager</option>
                    <option value="user">User</option>
                 </select>
                <x-form-error name="role"/> 

                <div id="manager" >
                <label for="manager">Choose a manager</label>
                 <select id="option" name="manager" class="manager">
                  <option value=""></option>
                </select>
                <x-form-error name="manager"/> 
                </div>

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
                  <x-form-submit type="submit">Register</x-form-submit>
                  <!-- /.col -->
                </div>
      </form>
                </div>
                <div class="modal-footer justify-content-between " >  
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
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
            type:"POST",
            url: "{{ route('getUserdetails') }}",
            data: { _token: '{{csrf_token()}}' },
        },
        columns: [
         
            {data: 'name', name: 'Name'},
            {data: 'email', name: 'Email'},
            {data: 'role',name: 'Role'},
            {data: 'manager',name: 'Manager'},
            {data:'action',name:'Action'},
        ]
    });


    $.ajax({
      url: "{{ route('admingetmanagername') }}",
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type:'POST',
      data: {
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {
          var names=response;
          let select = document.getElementById("option");

          for(let category in names){
            let name=names[category];
            let option = document.createElement("option");
            option.value = name.name; // Set value
            option.textContent = name.name; // Set text
            select.appendChild(option); 
          }

      },
    });

    $.ajax({
      url: "{{ route('dashboarduserid') }}",
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type:'POST',
      data: {
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {
        console.log(response);
        $('#admin_id').val(response);
      }
    });

    $.ajax({
      url: "{{ route('admingetmanagername') }}",
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type:'POST',
      data: {
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {
          var names=response;
          let select = document.getElementById("options");

          for(let category in names){
            let name=names[category];
            let option = document.createElement("option");
            option.value = name.name; // Set value
            option.textContent = name.name; // Set text
            select.appendChild(option); 
          }

      },
    });

    $(document).on('click', '.add-button', function(e) {
      $('#add-user').trigger("reset");
    });
    $(document).on('click', '.edit-button', function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    console.log(id);
    $('#edit-user').trigger("reset");
    $.ajax({
      url: "{{ route('editDetails') }}",
      type:'POST',
      data: {
        id: id,
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {
        console.log(response);
        $('#name').val(response[0].name);
        $('#email').val(response[0].email);
        $('#role').val(response[0].role);
        $('#options').val(response[0].manager)
        $('#id').val(response[0].id);
        $('#modal-edit-user').modal('show'); 
      }
      
    });
  });

  $(document).on('click', '.delete-button', function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    console.log(id);
    $(document).on('click','.deleter',function(e){
      console.log(id);
      $('#delete-user').trigger("reset");
    $.ajax({
      url: "{{ route('deleteuser') }}",
      type:'GET',
      data: {
        id: id,
        _token: '{{ csrf_token() }}',
      },
      success: function(response) {
        location.reload();
      },
    });
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