<!-- resources/views/news-admin/index.blade.php -->

@extends('layouts.app1')

@section('content')
    <main id="content" role="main" class="main">
        <div class="  px-5 rounded-0 shadow-none">
            <div class="page-header mt-3">
                <div class="row align-items-center ">
                    <div class="col">
                        <h1 class="page-header-title">News Articles</h1>
                    </div>
                    <!-- End Col -->

                    <div class="col-auto">
                        <a class="btn btn-primary" href="{{ route('news-admin.create') }}">
                            <i class="bi bi-pencil-fill me-1"></i>Create New Article
                        </a>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>

            <div class="card rounded-0 shadow-none">
                <!-- Header -->
                <div class="card-header">
                    <div class="row     align-items-end flex-grow-1">
                        <div class="col-2  ">
                           <div class="d-flex justify-content-between align-items-end">
                     <!-- Add an ID to the select element -->
                    <select id="taskFilter" class="card-header-title js-select js-datatable-filter form-select form-select-sm form-select-borderless" autocomplete="off"
                    data-target-column-index="1"
                    data-target-table="datatbleWithFilter"
                    data-hs-tom-select-options='{
                      "searchInDropdown": false,
                      "hideSearch": true,
                      "dropdownWidth": "10rem"
                    }'>
                    <option value="null" selected  class="mx-5">All</option>
                    <option value="published">Published</option>
                    <option value="unpublished">Unpublished</option>
                    <option value="pinned">Pinned</option>
                    <option value="unpinned">Unpinned</option>
                  </select>
                  
                    </div> 
                        </div>

                   
                    </div>
                </div>
                <!-- End Header -->

                <!-- Table -->
                  <div class="table-responsive datatable-custom position-relative">
                    @if($articles->isEmpty())
                    <div class="text-center p-4">
                        <img class="mb-3" src="{{ asset('assets/svg/illustrations/oc-error.svg') }}" alt="Image Description" style="width: 25%;" data-hs-theme-appearance="default">
                        <img class="mb-3" src="{{ asset('assets/svg/illustrations-light/oc-error.svg') }}" alt="Image Description" style="width: 25%;" data-hs-theme-appearance="dark">
                        <p class="mb-0">No data to show</p>
                        
                      </div>
                
                  @else
                    <table id="datatable"
                            class="table table-lg table-borderless table-thead-bordered table-align-middle card-table"
                                  data-hs-datatables-options='{
                        "columnDefs": [{
                            "targets": [0, 5],
                            "orderable": false
                          }],
                        "order": [],
                        "info": {
                          "totalQty": "#datatableWithPaginationInfoTotalQty"
                        },
                        "search": "#datatableSearch",
                        "entries": "#datatableEntries",
                        "pageLength": 10,
                        "isResponsive": false,
                        "isShowPaging": false,
                        "pagination": "datatablePagination"
                      }'>
                        <thead class="thead-light">
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Publish</th>
                                <th>Actions</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                     
                        <tbody>
                           
                            @foreach ($articles->sortByDesc('created_at') as $article)
                            <tr class="task-row {{ $article->published == 1 ? 'published' : 'unpublished' }} {{ $article->pinned == 1 ? 'pinned' : 'unpinned' }}">
                                    <td class="text-dark">{{ Str::limit($article->title, 55) }}</td>
                                    <td>
                                        <div class="  ">
                                            <span class="d-block h5 text-inherit mb-0">{{ $article->author->name }}
                                                {{ $article->author->last_name }} </span>
                                           
                                        </div>
                                    </td>
                                    <td>
                                        <div class=" col-auto form-check custom-switch form-switch mx-2">
                                            <input type="checkbox" class="form-check-input is-valid"
                                                id="published{{ $article->id }}"
                                                {{ $article->published == 1 ? 'checked' : '' }}>
                                            <script>
                                                $(document).ready(function() {
                                                    // Listen for changes in the checkbox
                                                    $('#published{{ $article->id }}').change(function() {
                                                        var isChecked = $(this).is(':checked');
                                                        var postId = {{ $article->id }};

                                                        // Send an AJAX request to update the published value
                                                        $.ajax({
                                                            url: '{{ route('postpublish') }}',
                                                            method: 'POST',
                                                            data: {
                                                                _token: '{{ csrf_token() }}',
                                                                postId: postId,
                                                                published: isChecked ? 1 : 0
                                                            },
                                                            success: function(response) {
                                                                console.log('Updated successfully.');
                                                            },
                                                            error: function(xhr) {
                                                                console.error('An error occurred while Publishing.');
                                                            }
                                                        });
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </td>

                                    <td class="nowrap-td">
                                      <span class="d-inline-flex">
                                          <!-- Unpinned Button -->
                                          <button class="btn btn-ghost-primary @if($article->pinned == 1 ) d-none  @endif"  id="unpinButton{{ $article->id }}"
                                              data-pinned="0"
                                              data-bs-toggle="tooltip"
                                              data-bs-placement="top"
                                              title="pin">
                                              <i class="bi bi-pin-angle me-2"></i> 
                                          </button>
                                  
                                          <!-- Pinned Button (Initially Hidden) -->
                                          <button class="btn btn-ghost-primary @if($article->pinned ==! 1 ) d-none  @endif" id="pinButton{{ $article->id }}"
                                              data-pinned="1"
                                              data-bs-toggle="tooltip"
                                              data-bs-placement="top"
                                              title="unpin">
                                              <i class="bi bi-pin-angle-fill me-2"></i> 
                                          </button>
                                  
                                          <script>
                                              $(document).ready(function() {
                                                  // Initialize tooltips
                                                  $('[data-bs-toggle="tooltip"]').tooltip();
                                  
                                                  // Listen for click events on both pin and unpin buttons
                                                  $('button[id^="unpinButton"], button[id^="pinButton"]').click(function() {
                                                      var button = $(this);
                                                      var isPinned = button.data('pinned') === 1;
                                                      var postId = button.attr('id').replace('unpinButton', '').replace('pinButton', '');
                                  
                                                      // Send an AJAX request to update the pinned status
                                                      $.ajax({
                                                          url: '{{ route('postpinned') }}',
                                                          method: 'POST',
                                                          data: {
                                                              _token: '{{ csrf_token() }}',
                                                              postId: postId,
                                                              pinned: !isPinned ? 1 : 0 // Toggle the pinned status
                                                          },
                                                          success: function(response) {
                                                              // Toggle the visibility of pin and unpin buttons
                                                              $('#unpinButton' + postId).toggleClass('d-none', !isPinned);
                                                              $('#pinButton' + postId).toggleClass('d-none', isPinned);
                                  
                                                              console.log('Updated successfully.');
                                                          },
                                                          error: function(xhr) {
                                                              console.error('An error occurred while pinning.');
                                                          }
                                                      });
                                                  });
                                              });
                                          </script>
                                  
                                          <a href="{{ route('news-admin.show', $article->id) }}" class="btn btn-info ms-2 bi bi-eye"></a>
                                          <a href="{{ route('news-admin.edit', $article->id) }}" class="btn btn-primary ms-2 bi bi-pencil-fill "></a>
                                  
                                          <!-- Button to Trigger Modal for Deleting an Article -->
                                          <button type="button" class="btn btn-outline-danger btn-sm ms-2" data-bs-toggle="modal"
                                              data-bs-target="#exampleModalCenterDeleteArticle{{ $article->id }}">
                                              <i class="bi-trash me-1"></i>
                                          </button>
                                  
                                          <!-- Modal for Deleting an Article -->
                                          <div id="exampleModalCenterDeleteArticle{{ $article->id }}" class="modal fade" tabindex="-1" role="dialog"
                                              aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                                  <div class="modal-content text-center">
                                                      <div class="modal-body">
                                                          <p class="text-dark">Are you sure you want to delete this article? <br>This action cannot be
                                                              undone.</p>
                                                          <button type="button" class="btn btn-soft-dark mx-4" data-bs-dismiss="modal">Cancel</button>
                                                          <!-- Form to handle the delete action -->
                                                          <form method="POST" action="{{ route('news-admin.destroy', $article->id) }}"
                                                              style="display:inline">
                                                              @method('DELETE')
                                                              @csrf
                                                              <button type="submit" class="btn btn-soft-danger">Yes, Delete</button>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                  
                                      </span>
                                  </td>
                                  
                                    <td>{{ $article->updated_at->format('M j, Y') }}</td>
                                </tr>
                            @endforeach



                       
                        </tbody>  
                       
                    </table>
                    @endif   
                </div>
                <!-- End Table -->

                <!-- Footer -->
                <div class="card-footer">
                  <!-- Pagination -->
        <div class="d-flex ">
            {{ $articles->links() }}
        </div>
        <!-- End Pagination -->
                </div>
                <!-- End Footer -->
            </div>
    </main>
    <script>
        $(document).ready(function() {
          // Initialize tooltips
          $('[data-bs-toggle="tooltip"]').tooltip();
      
          // Listen for changes in the select element
          $('#taskFilter').change(function() {
            var selectedOption = $(this).val();
      
            // Debugging output
            console.log('Selected option:', selectedOption);
      
            // Check if the selected option is "All" and refresh the page
            if (selectedOption === 'null') {
              window.location.reload();
            } else {
              // Otherwise, apply the filter without refreshing
              // Hide all rows initially
              $('.task-row').hide();
      
              // Show rows based on the selected filter
              $('.' + selectedOption).show();
            }
          });
        });
      </script>
      
      
      
@endsection
