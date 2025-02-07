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
            <a href="/task" class="nav-link">
              <p>
                User-progress
              </p>
            </a>
   </li>
</x-layout>    

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper kanban">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Progress</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content pb-3">
      <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-header">
            <h3 class="card-title">
              Backlog
            </h3>
          </div>
          <div class="card-body">
          <div class="card card-primary card-outline" id="backlog">
              
              </div>
            </div>
          </div>
          <div class="card card-row card-primary">
            <div class="card-header">
              <h3 class="card-title">
                To Do
              </h3>
            </div>
            <div class="card-body">
            <div class="card card-primary card-outline" id="todo">
              </div>
            </div>
          </div>
          <div class="card card-row card-default">
            <div class="card-header bg-info">
              <h3 class="card-title">
                In Progress
              </h3>
            </div>
            <div class="card-body">
            <div class="card card-primary card-outline" id="inprogress">
  
              </div>
            </div>
            </div>
          
          <div class="card card-row card-success">
            <div class="card-header">
              <h3 class="card-title">
                Done
              </h3>
            </div>
            <div class="card-body">
            <div class="card card-primary card-outline" id="completed">
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  
    <x-footer />
  
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
<!-- ./wrapper -->
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
                <form action="/edit-task-progress" class="edit-task-progress" id="edit-task-progress" method="post">
                @csrf
                <input type="hidden" name="id" class="id" id="id" value="">

                <label for="name">Choose an employee</label>
                <select id="option" name="name" class="name">
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
        $('.id').val(response[0].id);
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

    function displaybacklog(backlogs){
          for(let category in backlogs){
            let backlog=backlogs[category];
           
            let html=""; 
            if(backlog.length==0){
             
              html+=`<p>No Tasks available</p>`;
            }else{
              
              html+=`<div class="card-header">
                <h5 class="card-title" style="Font-weight:bold">Task:</h5>
                
                <div class="card-tools">
                <button type='submit' class='btn btn-default edit-button' data-id="${backlog.id}" data-toggle='modal' data-target='#edit-task-details'><i class="fas fa-pen"></i></button>
                  </a>
                </div><br>
                <span id="task"></span>
                <p>${backlog.task}<p>
                <h6 style="Font-weight:bold">Description:</h6>
                <span id="description"></span>
                <p>${backlog.description}<p>
                
                <h6 style="Font-weight:bold">Priority:</h6>
                <span id="priority"></span>
                <p>${backlog.priorty}<p>
                <h6 style="Font-weight:bold">Start_date:</h6>
                <span id="start_date"></span>
                <p>${backlog.start_date}<p>
                <h6 style="Font-weight:bold">End_date:</h6>
                <span id="end_date"></span>
                <p>${backlog.end_date}<p>
              </div>`
            }
            document.getElementById('backlog').innerHTML+=html;
          }
        } 
        function displaytodo(todo){
          for(let category in todo){
            let backlog=todo[category];
          
            let html=""; 
            if(backlog.length==0){
             
              html+=`<p>No Tasks available</p>`;
            }else{
              
              html+=`<div class="card-header">
                <h5 class="card-title" style="Font-weight:bold">Task:</h5>
                
                <div class="card-tools">
                <button type='submit' class='btn btn-default edit-button' data-id="${backlog.id}" data-toggle='modal' data-target='#edit-task-details'><i class="fas fa-pen"></i></button>
                  </a>
                </div><br>
                <span id="task"></span>
                <p>${backlog.task}<p>
                <h6 style="Font-weight:bold">Description:</h6>
                <span id="description"></span>
                <p>${backlog.description}<p>
                
                <h6 style="Font-weight:bold">Priority:</h6>
                <span id="priority"></span>
                <p>${backlog.priorty}<p>
                <h6 style="Font-weight:bold">Start_date:</h6>
                <span id="start_date"></span>
                <p>${backlog.start_date}<p>
                <h6 style="Font-weight:bold">End_date:</h6>
                <span id="end_date"></span>
                <p>${backlog.end_date}<p>
              </div>`
            }
            document.getElementById('todo').innerHTML+=html;
          }
        }
        function displaycompleted(completed){
          for(let category in completed){
            let backlog=completed[category];

            let html=""; 
            if(backlog.length==0){
             
              html+=`<p>No Tasks available</p>`;
            }else{
              
              html+=`<div class="card-header">
                <h5 class="card-title" style="Font-weight:bold">Task:</h5>
                
                <div class="card-tools">
                <button type='submit' class='btn btn-default edit-button' data-id="${backlog.id}" data-toggle='modal' data-target='#edit-task-details'><i class="fas fa-pen"></i></button>
                  </a>
                </div><br>
                <span id="task"></span>
                <p>${backlog.task}<p>
                <h6 style="Font-weight:bold">Description:</h6>
                <span id="description"></span>
                <p>${backlog.description}<p>
                
                <h6 style="Font-weight:bold">Priority:</h6>
                <span id="priority"></span>
                <p>${backlog.priorty}<p>
                <h6 style="Font-weight:bold">Start_date:</h6>
                <span id="start_date"></span>
                <p>${backlog.start_date}<p>
                <h6 style="Font-weight:bold">End_date:</h6>
                <span id="end_date"></span>
                <p>${backlog.end_date}<p>
              </div>`
            }
            document.getElementById('completed').innerHTML+=html;
          }
        }
        function displayinprogress(inprogress){
          for(let category in inprogress){
            let backlog=inprogress[category];
 
            let html=""; 
            if(backlog.length==0){
             
              html+=`<p>No Tasks available</p>`;
            }else{
              
              html+=`<div class="card-header">
                <h5 class="card-title" style="Font-weight:bold">Task:</h5>
                
                <div class="card-tools">
                <button type='submit' class='btn btn-default edit-button' data-id="${backlog.id}" data-toggle='modal' data-target='#edit-task-details'><i class="fas fa-pen"></i></button>
                  </a>
                </div><br>
                <span id="task"></span>
                <p>${backlog.task}<p>
                <h6 style="Font-weight:bold">Description:</h6>
                <span id="description"></span>
                <p>${backlog.description}<p>
                
                <h6 style="Font-weight:bold">Priority:</h6>
                <span id="priority"></span>
                <p>${backlog.priorty}<p>
                <h6 style="Font-weight:bold">Start_date:</h6>
                <span id="start_date"></span>
                <p>${backlog.start_date}<p>
                <h6 style="Font-weight:bold">End_date:</h6>
                <span id="end_date"></span>
                <p>${backlog.end_date}<p>
              </div>`
            }
            document.getElementById('inprogress').innerHTML+=html;
          }
        }


  $.ajax({
      url: "{{ route('managertaskLoader') }}",
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type:'POST',
      data: {
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {

        
        var backlogs=response['Backlog'];
        var todo=response['ToDo'];
        var completed=response['Completed'];
        var inprogress=response['Inprogress'];
        
        displaybacklog(backlogs);
        displaytodo(todo);
        displaycompleted(completed);
        displayinprogress(inprogress);
      },
     
    });
  });
</script>
</body>
</html>
