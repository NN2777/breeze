<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    
    <div class="container">
        <div class="card mt-5">
          <div class="card-header">
            <h2 class="text-xl font-semibold leading-tight"> <?php echo e($topic->topic_name); ?> </h2>
          </div>
          <div class="card-body">
            <p class="card-text"><?php echo e($topic->description); ?></p>
            <br>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <span>Upload PDF</span>
            </button>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
              <span>Tambah Soal</span>
            </button>
          </div>
          

           <!-- Button trigger modal -->
        

          <!-- <div class="card-body"> -->
            <!-- <form action="<?php echo e(route('uploadPDF')); ?>" method="POST" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <div>
                  <label for="pdf_file">PDF File:</label>
                  <input type="file" id="pdf_file" name="pdf_file" accept="application/pdf">
              </div>
              <div>
                <input type="number" id="topic_id" name="topic_id" value=<?php echo e($topic->id); ?> hidden>
              </div>
              <div>
                  <label for="file_name">File Name:</label>
                  <input type="text" id="file_name" name="file_name">
              </div>
              <button type="submit">Upload</button>
          </form> -->
          <!-- </div> -->
          <div class="card-body">
            <?php if($pdfFiles->isNotEmpty()): ?>
              <ul class="list-group">
                <?php $__currentLoopData = $pdfFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pdf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                <li class="list-group-item"> <a href="<?php echo e(route('downloadPDF', ['id' => $pdf->id])); ?>" target="_blank">Download <?php echo e($pdf->file_name); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>  
            <?php endif; ?>
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
            <form action="<?php echo e(route('uploadPDF')); ?>" method="POST" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
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
                    <input type="number" id="topic_id" name="topic_id" value=<?php echo e($topic->id); ?> hidden>
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
            <form action="<?php echo e(route('task.create', ['id' => $topic->id])); ?>" method="POST" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Tulis pertanyaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="mb-3">
                    <input type="text" id="question" name="question">
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
      
      <script>
          $(document).ready(function() {
              $('#myTable').DataTable({
                ajax: {
                    url: "<?php echo e(route('topic.gettaskdata', ['id' => $topic->id])); ?>",
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Naufal Nafidiin\Koding\breeze\resources\views/topic.blade.php ENDPATH**/ ?>