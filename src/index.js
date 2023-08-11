// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyDDmAQL43jrKyBcnouuuKy16wHAxJKxr0U",
  authDomain: "elife-saver.firebaseapp.com",
  projectId: "elife-saver",
  storageBucket: "elife-saver.appspot.com",
  messagingSenderId: "776266287551",
  appId: "1:776266287551:web:e59c2f32e122fe4732790a",
  measurementId: "G-FK7KVVZM1F"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);

// Request permission to send notifications
messaging.requestPermission().then(() => {
  console.log('Notification permission granted.');

  // Get the registration token
  messaging.getToken().then((token) => {
    console.log('Registration token:', token);
    // Send the registration token to your server to associate it with the donor
    // ...
  }).catch((error) => {
    console.log('Error getting registration token:', error);
  });
}).catch((error) => {
  console.log('Error requesting notification permission:', error);
});