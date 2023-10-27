@extends('layouts.app1')
@section('content')
<main id="content" role="main" class="main">
<div class="card rounded-0">
    <div class="card-body">
        {{-- <h3 class="card-title mb-2">Activity Stream </h3> --}}
        <div id="reloadButton" type="" class="card-pinned-top-end h4" onclick="reloadPage()" style="display: none;">
            {{-- <i class="bi bi-arrow-clockwise"></i> Reload --}}
            <span id="newMessagesCount" class="badge bg-primary"></span>
        </div>
        
{{-- script for neww message button starts --}}
        <script>
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
        </script>
        <div class="row align-items-center gx-2">
            <script>
                const authUserId = "{{ Auth::user()->id }}";
            </script>
            {{-- <div id="message-container">Welcome {{ Auth::user()->name }}!</div> --}}
            <ul id="mqtt-messages-list">
                <!-- Messages will be dynamically loaded here -->
            </ul>
            
            <!-- Pagination -->
<nav class="d-sm-flex justify-content-sm-between align-items-sm-center text-center" aria-label="Page navigation example">
    <ul class="pagination justify-content-center justify-content-sm-end">
        <li class="page-item" id="previous-page">
            <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>
        <!-- Page number items will be dynamically added here -->
        <li class="page-item page-number"><a class="page-link" href="#">1</a></li>
        <li class="page-item page-number"><a class="page-link" href="#">2</a></li>
        <li class="page-item page-number"><a class="page-link" href="#">3</a></li>
        <li class="page-item page-number"><a class="page-link" href="#">4</a></li>
        <li class="page-item page-number"><a class="page-link" href="#">5</a></li>
        <!-- Add more page number items here as needed -->
        <li class="page-item" id="next-page">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
    <small class="text-muted" id="showing-of">Showing x of y</small>
</nav>
<!-- End Pagination -->



        </div>
        <!-- End Row -->
    </div>
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

//             // Limit the number of displayed messages to the last 3
//             var startIndex = Math.max(0, data.length - 8);
//             var displayedMessages = data.slice(startIndex);

//             // Reverse the order of displayed messages (display last message first)
//             displayedMessages.reverse();

//             // Loop through the last 3 received messages and append them to the list
//             var currentTime = new Date().getTime();
//             $.each(displayedMessages, function (index, message) {
//                 // Extract the topic text after the user ID (assuming the topic format is "userID/topicText")
//                 var topicParts = message.topic.split('/');
//                 var topicText = topicParts.slice(1).join('/');

//                 var messageTime = new Date(message.created_at).getTime();
//                 var timeDiffInMinutes = (currentTime - messageTime) / (1000 * 60);
//                 var timeText = formatTimeDifference(timeDiffInMinutes);

//                 // var listItem = '' +
//                 //     '<strong> ' + topicText + '</strong> ' + message.payload + ' - ' + timeText + '' +
//                 //     '<br>';
              
//                     var listItem = '' +
//                     '<div class="">' +
//                         '<div class=" d-flex justify-content-between align-items-center">' +
//                             '<div>' +
//                                 '<strong>' + topicText + '</strong>: ' + message.payload +
//                             '</div>' +
//                             '<div class="text-muted">' + timeText + '</div>' +
//                         '</div>' +
//                     '</div>';
                
            
  

//                 $mqttMessagesList.append(listItem);
//             });
//         },
//         error: function (error) {
//             console.log(error);
//         }
//     });
// }


// // Call the displayMqttMessages function initially to load messages on page load
// displayMqttMessages();

// // Set an interval to refresh messages every 5 seconds (adjust as needed)
// // setInterval(function () {
// //     displayMqttMessages();
// // }, 5000); // 5000 milliseconds = 5 s
// </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
        const itemsPerPage = 10; // Adjust this based on your preference
        const $messageList = $('#mqtt-messages-list');
        const $pageNumbers = $('.page-number');
        const $previousPage = $('#previous-page');
        const $nextPage = $('#next-page');
        const $showingOf = $('#showing-of'); // Reference to the "Showing x of y" element
        
        let currentPage = 1;

        // Function to load MQTT messages for a specific page
        function displayMqttMessages(page) {
            $.ajax({
                url: '/mqtt-messages',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $messageList.empty();

                    // Limit the number of displayed messages per page
                    var startIndex = Math.max(0, data.length - (page * itemsPerPage));
                    var endIndex = startIndex + itemsPerPage;
                    var displayedMessages = data.slice(startIndex, endIndex);

                    // Reverse the order of displayed messages (display newer messages first)
                    displayedMessages.reverse();

                    var currentTime = new Date().getTime();
                    $.each(displayedMessages, function (index, message) {
                        // Your existing message rendering code here...
                        var topicParts = message.topic.split('/');
                        var topicText = topicParts.slice(1).join('/');

                        var messageTime = new Date(message.created_at).getTime();
                        var timeDiffInMinutes = (currentTime - messageTime) / (1000 * 60);
                        var timeText = formatTimeDifference(timeDiffInMinutes);

                        var listItem = `
                        <!-- Card -->
<div class="">
  <div class="">
    <div class="row bg-light mb-2 rounded-2">
        <div class="col-lg-2  col-md-2 col-sm-12 bg-soft-dark py-2 rounded-2">
          <b>  ${topicText}</b>
        </div>

        <div class="col-lg-10 col-md-10 col-sm-12 bg-light py-2 rounded-2 ">
            <div class="row">
                <div class="col text-dark">
                    ${message.payload}
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    ${timeText}
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
    </div>
  </div>
</div>
<!-- End Card -->
   `;
                        
                        $messageList.append(listItem);
                    });

                    // Update the "Showing x of y" text
                    updateShowingOfText(data.length);

                    // Call the pagination update function
                    updatePagination();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }


     // Load initial MQTT messages
     displayMqttMessages(currentPage);
// // Set an interval to refresh messages every 5 seconds (adjust as needed)
// setInterval(function () {
//     displayMqttMessages();
// }, 5000); // 5000 milliseconds = 5 s
// Function to update the "Showing x of y" text
function updateShowingOfText(totalMessages) {
    const startIdx = (currentPage - 1) * itemsPerPage + 1;
    const endIdx = Math.min(currentPage * itemsPerPage, totalMessages);
    $showingOf.text(`Showing ${startIdx} - ${endIdx} of ${totalMessages}`);
}

// Function to update pagination button states
function updatePagination() {
    $pageNumbers.removeClass('active');
    $pageNumbers.eq(currentPage - 1).addClass('active');
    
    $previousPage.toggleClass('disabled', currentPage === 1);
    $nextPage.toggleClass('disabled', currentPage === $pageNumbers.length);
}

// Click event handler for page numbers
$pageNumbers.on('click', function() {
    const pageNumber = parseInt($(this).text());
    currentPage = pageNumber;
    displayMqttMessages(currentPage);
});

// Click event handler for Previous button
$previousPage.on('click', function() {
    if (currentPage > 1) {
        currentPage--;
        displayMqttMessages(currentPage);
    }
});

// Click event handler for Next button
$nextPage.on('click', function() {
    currentPage++;
    displayMqttMessages(currentPage);
});

// Function to update pagination button states
function updatePagination() {
    $pageNumbers.removeClass('active');
    $pageNumbers.eq(currentPage - 1).addClass('active');
    
    $previousPage.toggleClass('disabled', currentPage === 1);
    $nextPage.toggleClass('disabled', currentPage === $pageNumbers.length);
}
});
</script>
@endsection