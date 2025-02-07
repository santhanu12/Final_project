<x-layout>

</x-layout>


<div class="login-page">
      <div class="login-box" style="margin-left:250px">
        <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body">
            <div class="login-logo">
              
            </div>
            <h4 class="login-box-msg"><strong>User Information</strong></h4>
            <h6><strong>Username:</strong><div id='username'></div></h6>
            <h6><strong>Email:</strong><div id='useremail'></div></h6>
            <h6><strong>Role:</strong><div id='userrole'></div></h6>
            <button type='submit' class='btn btn-default edit-button' data-toggle='modal' data-target='#edit-user-details'>Edit</button>
            </div>
         </div>
       </div>
    </div>
<x-footer></x-footer>


</body>
<div class="modal fade" id="edit-user-details">
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
        <form action="/edit-user-details" class="edit-user" id="edit-user" method="post">
        @csrf
        <input type="hidden" id="id" name="id" value="">

        <x-form-input type="text" id="uname" name="name" value="" />
        <x-form-error name="name" /> 
        
        <x-form-input  type="email" id="email" name="email" value=""/>
        <x-form-error name="email" />

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

    $(document).on('click', '.edit-button', function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    $('#edit-user').trigger("reset");
    $.ajax({
      url: "{{ route('editdashboardDetails') }}",
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type:'POST',
      data: {
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {
        console.log(response);
        $('#uname').val(response[0].name);
        $('#email').val(response[0].email);
        $('#id').val(response[0].id);
        $('#edit-user-details').modal('show');
      }
    });
  });

  
    $.ajax({
      url: "{{ route('editdashboardDetails') }}",
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type:'POST',
      data: {
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {
        console.log(response);
        let id=response[0].id;
        let name=response[0].name;
        let email=response[0].email;
        let role=response[0].role;
      
        document.getElementById('username').innerHTML=name;
        document.getElementById('useremail').innerHTML=email;
        document.getElementById('userrole').innerHTML=role;
      }
    });

 
      });
    </script>
</html>