<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MQTT Topic Input</title>
</head>
<body>
  <h1>MQTT Topic Input</h1>
  <input type="text" id="topicInput" placeholder="Enter MQTT topic">
  <button id="subscribeButton">Subscribe</button>

  <div id="messageContainer"></div>

  <script>
    // Establish WebSocket connection
    const socket = new WebSocket('ws://3.7.94.230:3000');
    
    // Handle WebSocket connection open event
    socket.addEventListener('open', (event) => {
      console.log('WebSocket connection established');
    });

    // Handle WebSocket connection close event
    socket.addEventListener('close', (event) => {
      console.log('WebSocket connection closed');
    });

    // Handle WebSocket message event
    socket.addEventListener('message', (event) => {
      const data = JSON.parse(event.data);
      const { topic, message } = data;
      const messageContainer = document.getElementById('messageContainer');
      const messageElement = document.createElement('p');
      messageElement.textContent = `Received message from ${topic}: ${message}`;
      messageContainer.appendChild(messageElement);
    });

    // Handle button click event
    const subscribeButton = document.getElementById('subscribeButton');
    subscribeButton.addEventListener('click', () => {
      const topicInput = document.getElementById('topicInput');
      const topic = topicInput.value;

      // Clear previous messages
  const messageContainer = document.getElementById('messageContainer');
  messageContainer.innerHTML = '';
      // Send MQTT topic to the server via WebSocket
      socket.send(topic);
    });
  </script>
</body>
</html>
