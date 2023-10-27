@extends('layouts.app1')
@section('content')
<main id="content" role="main" class="main">
<div class="card rounded-0">
    <div class="card-body">
        {{-- <h3 class="card-title mb-2">Activity Stream </h3> --}}
        <div id="reloadButton" type="" class="card-pinned-top-end h4" onclick="reloadPage()" style="display: none;">
            {{-- <i class="bi bi-arrow-clockwise"></i> Reload --}}
            {{-- <span id="newMessagesCount" class="badge bg-primary"></span> --}}
        </div>
      <!-- Page Header -->
<div class="mb-2   ">
    <div class="row ">
        <div class="col-6 mb-2">
            <div class="">  
                <div class="form-check my-2 ">
                    <input type="checkbox" id="selectAllCheck" class="form-check-input">
                    <label class="form-check-label" for="selectAllCheck">Select All</label>
                </div>
            </div>
        </div>
           
        <div class="col d-flex justify-content-end ">
            <button type="button" class="btn btn-danger ms-3 btn-lg" id="delete-button" ><i class="bi bi-trash me-2"></i>Delete</button>
              {{-- <button type="button" class="btn btn-danger ms-3" id="delete-all">Delete All Messages</button> --}}
        
              <a href="{{ route('inbox') }}" class="btn btn-outline-primary ms-3 btn-lg"    >Back</a>

       
      </div>
    </div>
  </div>
  <!-- End Page Header -->
        
        {{-- script for neww message button starts --}}
        {{-- <script>
            function reloadPage() {
                location.reload();
            }

            function updateNewMessagesCount() {
                var lastViewedTime = '{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}';

                $.ajax({
                    url: "{{ url('get-new-messages-count') }}/" + lastViewedTime,
                    method: "GET",
                    success: function(response) {
                        var newMessagesCount = response.newMessagesCount;
                        var newMessagesText = newMessagesCount + " New message" + (newMessagesCount !== 1 ? "s" : "");
        
                       if (newMessagesCount > 0 && $('#livemode').is(':checked')) {
                        $("#reloadButton").show();

                        // Reload the page after 15 seconds
                        setTimeout(function() {
                            location.reload();
                        }, 15000);
                    } else {
                        if (newMessagesCount > 0) {
                            $("#reloadButton").show();
                        } else {
                            $("#reloadButton").hide();
                        }
                        }
        
                        $("#newMessagesCount").text(newMessagesText);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }

            // Call the updateNewMessagesCount function every 5 seconds (adjust the interval as needed)
            setInterval(updateNewMessagesCount, 5000);
        </script> --}}
       
            <script>
                const authUserId = "{{ Auth::user()->id }}";
            </script>
            {{-- <div id="message-container">Welcome {{ Auth::user()->name }}!</div> --}}
            <div class="row align-items-center gx-2">
                <form id="delete-form" method="POST" action="{{ route('delete.messages') }}">
                    @csrf
                    @method('DELETE')
                    
                    {{-- <ul id="mqtt-messages-list"> --}}
                         @foreach ($mqttMessagesCollection as $message) 
                            
                         <!-- Card -->
        <div class="row mb-3 bg-light rounded-2">
            <div class="col-lg-2 col-md-2 col-sm-12 bg-soft-dark py-2 rounded-2">
                <!-- Check -->
                <span class="form-check">
                    <input type="checkbox" name="message_ids[]" class="form-check-input" value="{{ $message->id }}">
                    <b class="text-dark ms-3">{{  $message->topic }}</b>
                </span>
                <!-- End Check -->
            </div>
            <div class="col-lg-10 col-md-10 col-sm-12 bg-light py-2 rounded-2">
                <div class="row">
                    <div class="col text-dark">
                        @if($message->payload)
                       {{ $message->payload }}
                    @else
                    <span class="text-muted"> Undefined action</span> 
                    @endif
                    

                    </div>
                    <div class="col-auto">
                        {{ $message->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
                
                        @endforeach
                        
                        {{-- @forelse ($mqttMessagesCollection as $message)
                            <!-- Card -->
                            <div class="row mb-3 bg-light rounded-2">
                                <div class="col-lg-2 col-md-2 col-sm-12 bg-soft-dark py-2 rounded-2">
                                    @php
                                        $topicParts = explode('/', $message->topic);
                                        $lastTopicPart = end($topicParts);
                                    @endphp
                                    <!-- Check -->
                                    <span class="form-check">
                                        <input type="checkbox" name="message_ids[]" class="form-check-input" value="{{ $message->id }}">
                                        <b class="text-dark ms-3">{{ $lastTopicPart }}</b>
                                    </span>
                                    <!-- End Check -->
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 bg-light py-2 rounded-2">
                                    <div class="row">
                                        <div class="col text-dark">
                                            {{ $message->payload }}
                                        </div>
                                        <div class="col-auto">
                                            {{ $message->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Card -->
                        @empty
                            <p class="no-messages">No messages found.</p>
                        @endforelse --}}
                    {{-- </ul> --}}
                    {{-- <button type="button" class="btn btn-danger" id="delete-button" style="display: none;">Delete</button>
                    <button type="button" class="btn btn-secondary" id="select-all" style="display: none;">Select All</button>
                    <button type="button" class="btn btn-danger" id="delete-all">Delete All Messages</button> --}}
                
                    <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete Messages</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete the selected messages?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form id="delete-form" method="POST" action="{{ route('delete.messages') }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <!-- Delete All Confirmation Modal -->
        <div class="modal fade" id="deleteAllModal" tabindex="-1" aria-labelledby="deleteAllModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteAllModalLabel">Delete All Messages</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete all messages from all pages?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form id="delete-all-form" method="POST" action="{{ route('activity.delete.all') }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete All</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                   
        
        <!-- Display manual pagination links -->
      
                </form>
                
                <div class="pagination">
                    {{ $mqttMessagesCollection->links() }}
                </div> 
            
        </div>
        <!-- End Row -->
        <script>
           document.addEventListener("DOMContentLoaded", function() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const deleteButton = document.getElementById('delete-button');
    const selectAllButton = document.getElementById('selectAllCheck');
    const deleteAllButton = document.getElementById('delete-all');
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            updateDeleteButton();
        });
    });
    
    selectAllButton.addEventListener('change', () => {
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAllButton.checked;
        });
        updateDeleteButton();
    });
    
    deleteButton.addEventListener('click', () => {
        const selectedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
        const messageCount = selectedCheckboxes.length;
        
        if (messageCount > 0) {
            $('#deleteModal').modal('show'); // Open the confirmation modal
        }
    });
    
    deleteAllButton.addEventListener('click', () => {
        $('#deleteAllModal').modal('show'); // Open the confirmation modal for deleting all messages
    });
    
    function updateDeleteButton() {
        const selectedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
        const selectedCount = selectedCheckboxes.length;
        
        if (selectedCount > 0) {
            // If the "Select All" checkbox is selected, include its count as well
            const totalMessagesCount = checkboxes.length;
            const selectAllChecked = selectAllButton.checked;
            const adjustedCount = selectAllChecked ? selectedCount - 1 : selectedCount;

            deleteButton.style.display = 'block';
            deleteButton.textContent = `Delete (${adjustedCount}) selected`;
        } else {

                  deleteButton.style.display = 'block';
                  deleteButton.textContent = `Delete selected`;
        }
    }
});

        </script>
        
        
</div>
<!-- End Card -->
</main>
<script>
    function formatTimeDifference(timeDiff) {
    if (timeDiff < 1) {
        return "just now";
    } else if (timeDiff < 60) {
        return Math.floor(timeDiff) + " min ago";
    } else if (timeDiff < 1440) {
        return Math.floor(timeDiff / 60) + " hour ago";
    } else {
        return Math.floor(timeDiff / 1440) + " day ago";
    }
}
// function displayMqttMessages() {
//     $.ajax({
//         url: '/mqtt-messages',
//         type: 'GET',
//         dataType: 'json',
//         success: function (data) {
//             var $mqttMessagesList = $('#mqtt-messages-list');
//             $mqttMessagesList.empty();

//             if (data.length === 0) {
//                 $mqttMessagesList.append('<p>No messages found.</p>');
//             } else {
//                 var startIndex = Math.max(0, data.length - 8);
//                 var displayedMessages = data.slice(startIndex);
//                 displayedMessages.reverse();

//                 var currentTime = new Date().getTime();
//                 $.each(displayedMessages, function (index, message) {
//                     var topicParts = message.topic.split('/');
//                     var topicText = topicParts.slice(1).join('/');

//                     var messageTime = new Date(message.created_at).getTime();
//                     var timeDiffInMinutes = (currentTime - messageTime) / (1000 * 60);
//                     var timeText = formatTimeDifference(timeDiffInMinutes);

//                     var listItem = `
//                         <!-- Card -->
//                         <div class="">
//                           <div class="">
//                             <div class="row bg-light mb-2 rounded-2">
//                                 <div class="col-lg-2 col-md-2 col-sm-12 bg-soft-dark py-2 rounded-2">
//                                   <b>${topicText}</b>
//                                 </div>
//                                 <div class="col-lg-10 col-md-10 col-sm-12 bg-light py-2 rounded-2 ">
//                                     <div class="row">
//                                         <div class="col text-dark">
//                                             ${message.payload}
//                                         </div>
//                                         <div class="col-auto">
//                                             ${timeText}
//                                         </div>
//                                     </div>
//                                 </div>
//                             </div>
//                           </div>
//                         </div>
//                         <!-- End Card -->
//                     `;

//                     $mqttMessagesList.append(listItem);
//                 });
//             }
//         },
//         error: function (error) {
//             console.log(error);
//         }
//     });
// }

// Call the displayMqttMessages function initially to load messages on page load
// displayMqttMessages();

// Set an interval to refresh messages every 5 seconds (adjust as needed)
// setInterval(function () {
//     displayMqttMessages();
// }, 5000); // 5000 milliseconds = 5 s
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection