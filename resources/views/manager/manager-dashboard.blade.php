

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
                <h3 class="card-title">Manager</h3>
                <h3 class="card-title-left" style="margin-left:830px"><button type='submit' class='btn btn-default taskadder-button' data-toggle='modal' data-target='#modal-default'>Add-task</button></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="tasks" class="table table-bordered table-hover"> 
                  <thead>
                    <tr>
                      
                      <th>Name</th>
                      <th>Task</th>
                      <th>End Date</th> 
                      <th>Status</th>
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

<!--Add-task-->

<div class="modal fade" id="modal-default">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">             
                   <h4 class="modal-title">Add-Task</h4>
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
                <form action="/add-task" class="add-task" id="add-task" method="post">
                @csrf
                <input type="hidden" name="manager_id" id="manager_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="user_id" class="user_id" id="user_id" value="">



                <label for="name">Choose an employee</label>
                <select id="option" name="name" class="name">
                  <option value=""></option>
                </select>
                <x-form-error name="name" /> <br>
                
                <label for="task">Task:</label>
                <x-form-input  type="text" id="task" name="task"/>
                <x-form-error name="task" />

                <label for="start_date">Start_date:</label>
                <x-form-input type="date" id="start_date" name="start_date"/>
                <x-form-error name="start_date" />

                <label for="end_date">End_date:</label>
                <x-form-input type="date" id="end_date" name="end_date"/>
                <x-form-error name="end_date" />

                <label for="priorty">Priorty:</label>
                <x-form-input type="text" id="priorty" name="priorty"/>
                <x-form-error name="priorty" />
                
                
                <label for="status">Status:</label>
                <select id="status" name="status">
                  <option value="To Do">To Do</option>
                  <option value="Backlog">Backlog</option>
                  <option value="Inprogress">Inprogress</option>
                </select>
                <x-form-error name="status" /><br>

                <label for="description">Description:</label><br>
                <textarea type="text" id="description" name="description">
                </textarea>
                <x-form-error name="description" />

                <div class="row">
                  <div class="col-8">
                    <div class="icheck-primary">
                    </div>
                  </div>
                  <!-- /.col -->
                  <x-form-submit type="submit">Add-Task</x-form-submit>
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


<!--View-task-->

<div class="modal fade" id="edit-task-details">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">             
                   <h4 class="modal-title">Edit-Task</h4>
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
                <form action="/edit-task" class="edit-task" id="edit-task" method="post">
                @csrf
                <input type="hidden" name="id" class="idname" id="id" value="">

                <label for="name">Choose an employee</label>
                <select id="options" name="name" class="name">
                  <option value=""></option>
                </select>
                <x-form-error name="name" /> <br>
                
                <label for="task">Task:</label>
                <x-form-input  type="text" class="task" id="task" name="task"/>
                <x-form-error name="task" />

                <label for="end_date">End_date:</label>
                <x-form-input type="date" id="end_date" name="end_date" class="end_date"/>
                <x-form-error name="end_date" />

                <label for="priorty">Priorty:</label>
                <x-form-input type="text" id="priorty" class="priorty" name="priorty"/>
                <x-form-error name="priorty" />
                
                
                <label for="status">Status:</label>
                <select id="status" name="status" class="status">
                  <option value="To Do">To Do</option>
                  <option value="Backlog">Backlog</option>
                  <option value="Inprogress">Inprogress</option>
                </select>
                <x-form-error name="status" /><br>

                <label for="description">Description:</label><br>
                <textarea type="text" id="description" name="description" class="description">
                </textarea>
                <x-form-error name="description" />

                <div class="row">
                  <div class="col-8">
                    <div class="icheck-primary">
                    </div>
                  </div>
                  <!-- /.col -->
                  <x-form-submit type="submit">Edit-Task</x-form-submit>
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
    
  var gettasks = "{{ route('getTasks') }}";
    
  $('#tasks').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            url: gettasks,
            data: {_token: '{{csrf_token()}}' },
        },
        columns: [
            {data: 'name', name: 'Name'},
            {data: 'task', name: 'Task'},
            {data: 'end_date',name: 'End Date'},
            {data: 'status',name: 'Status'},
            {data:'action',name:'Action'},
        ]
    });


    $.ajax({
      url: "{{ route('getusername') }}",
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
      url: "{{ route('getusername') }}",
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


    $(document).on('click', '.edit-button', function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    $('#edit-task').trigger("reset");
    $.ajax({
      url: "{{ route('taskeditDetails') }}",
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type:'POST',
      data: {
        id: id,
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {
        $('.idname').val(response[0].id);
        $('.name').val(response[0].name);
        $('.task').val(response[0].task);
        $('.end_date').val(response[0].end_date);
        $('.priorty').val(response[0].priorty);
        $('.status').val(response[0].status);
        $('.description').val(response[0].description); 
      $('#edit-task-details').modal('show');
      },
    });
  });


  $(document).on('click', '.delete-button', function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    console.log(id);
    $(document).on('click','.deleter',function(e){
      console.log(id);
    $.ajax({
      url: "{{ route('deletetaskDetails') }}",
      
      type:'POST',
      data: {
        id: id,
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {
        location.reload();
      },
    });
  });
    });
  });

    </script>

</body>
</html>