<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>
    <div class="container">
        <div class="card mt-5">
          <div class="card-header">
              <h1> {{ $topic->topic_name}} </h1>
          </div>
          <div class="card-body">
            <p class="card-text">{{ $topic->description }}</p>
            <br>
              <table id="myTable" class="table">
                  <thead>
                    <tr>
                      <th>Task No</th>
                      <th>Question</th>
                      <th>Show</th>
                    </tr>
                  </thead>
                </table>
          </div>
      </div>
      </div>
      
      
      <script>
          $(document).ready(function() {
              $('#myTable').DataTable({
                ajax: {
                    url: "{{ route('topic.gettaskdata', ['id' => $topic->id]) }}",
                },
                dom: 'Brtip',
                columns: [
                  { data: 'task_no', width: '10%'},
                  { data: 'question', width :'50%'},
                  { data: 'aksi', searchable: false, sortable: false, width:'10%'},
                ],
                paging: true,
                searching: true,
                processing: true,
                serverSide: true,
                ordering: true,
                stateSave: false,
                // Add more options as needed
              });
      });
      </script>
</x-app-layout>
