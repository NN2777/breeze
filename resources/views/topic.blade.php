<x-app-layout>
    {{-- <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot> --}}
    <div class="container">
        <div class="card mt-5">
          <div class="card-header">
            <h2 class="text-xl font-semibold leading-tight"> {{ $topic->topic_name}} </h2>
          </div>
          <div class="card-body">
            <p class="card-text">{{ $topic->description }}</p>
            <br>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <span>Upload PDF</span>
            </button>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
              <span>Tambah Soal</span>
            </button>
          </div>
          

           <!-- Button trigger modal -->
        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="">
          Launch demo modal
        </button> --}}

          <!-- <div class="card-body"> -->
            <!-- <form action="{{ route('uploadPDF') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div>
                  <label for="pdf_file">PDF File:</label>
                  <input type="file" id="pdf_file" name="pdf_file" accept="application/pdf">
              </div>
              <div>
                <input type="number" id="topic_id" name="topic_id" value={{ $topic->id }} hidden>
              </div>
              <div>
                  <label for="file_name">File Name:</label>
                  <input type="text" id="file_name" name="file_name">
              </div>
              <button type="submit">Upload</button>
          </form> -->
          <!-- </div> -->
          <div class="card-body">
            @if($pdfFiles->isNotEmpty())
              <ul class="list-group">
                @foreach($pdfFiles as $pdf)  
                <li class="list-group-item"> <a href="{{ route('downloadPDF', ['id' => $pdf->id]) }}" target="_blank">Download {{ $pdf->file_name }}</a></li>
                @endforeach
              </ul>  
            @endif
          </div>
          <div class="card-body">
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
      
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form action="{{ route('uploadPDF') }}" method="POST" enctype="multipart/form-data">
              @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukkan data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="mb-3">
                    <input class="form-control form-control-sm" id="formFileSm" type="file" type="file" id="pdf_file" name="pdf_file" accept="application/pdf">
                  </div>
                  <div class="mb-3">
                    <input type="number" id="topic_id" name="topic_id" value={{ $topic->id }} hidden>
                  </div>
                  <div class="mb-3">
                      <label for="file_name">File Name:</label>
                      <input type="text" id="file_name" name="file_name">
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" style="background-color:#0D6EFD">Save changes</button>
                  </div>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('task.create', ['id' => $topic->id]) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel2">Tulis pertanyaan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <input type="text" id="question" name="question">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color:#0D6EFD">Close</button>
          <button type="submit" class="btn btn-primary" style="background-color:#0D6EFD">Save changes</button>
        </div>
      </div>
    </form>
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
