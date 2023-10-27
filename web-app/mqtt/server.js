const express = require('express');
const mqtt = require('mqtt');
const WebSocket = require('ws');

const app = express();
const port = 8000; // Port number for the server

// MQTT broker URL
const brokerUrl = 'mqtt://43.205.51.194:1883';

// MQTT authentication credentials

// MQTT authentication credentials
const username = 'blueman';
const password = 'TYgu6fPhoofJ';

// Create a client instance
const client = mqtt.connect(brokerUrl, {
  username: username,
  password: password
});

// Store the WebSocket connections
const connections = [];

// Callback triggered on successful connection
client.on('connect', () => {
  console.log('Connected to MQTT broker');
});


// Callback triggered when a message is received
client.on('message', (receivedTopic, message) => {
  console.log('Received message from', receivedTopic, ':', message.toString());

  // Send the message to all WebSocket connections
  connections.forEach((ws) => {
    if (ws.readyState === WebSocket.OPEN) {
      ws.send(JSON.stringify({
        topic: receivedTopic,
        message: message.toString()
      }));
    }
  });
});

// Callback triggered when the client is disconnected
client.on('close', () => {
  console.log('Disconnected from MQTT broker');
});

// Handle any errors that occur
client.on('error', (err) => {
  console.error('Error:', err);
});

// Serve the HTML file
app.use(express.static('public'));

// WebSocket server
const wss = new WebSocket.Server({ noServer: true });

// Upgrade the HTTP server to support WebSocket
const server = app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});

server.on('upgrade', (request, socket, head) => {
  wss.handleUpgrade(request, socket, head, (ws) => {
    wss.emit('connection', ws, request);
  });
});

// WebSocket connection handler
wss.on('connection', (ws) => {
  console.log('WebSocket connection established');

  // Add the WebSocket connection to the list
  connections.push(ws);

  // Remove the WebSocket connection on close
  ws.on('close', () => {
    console.log('WebSocket connection closed');
    const index = connections.indexOf(ws);
    if (index !== -1) {
      connections.splice(index, 1);
    }
  });

  // Receive MQTT topic from the client
  ws.on('message', (data) => {
    const topic = data.toString();

    // Subscribe to the topic
    client.subscribe(topic, (err) => {
      if (err) {
        console.error('Failed to subscribe:', err);
      } else {
        console.log('Subscribed to', topic);
      }
    });
  });
});
