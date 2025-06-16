import React from 'react';
import EventList from '../components/EventList';
import '../assets/css/HomePage.css'; // Assuming you have a CSS file for styling
import Navbar from '../components/NavBar.jsx'; // Importing the Navbar component
import Nav from '../components/Footer.jsx';

<Navbar />

const HomePage = () => {
  return (
    <div className="home-page">
      <h1>Welcome to JPO Connect</h1>
      <p>Discover and register for our upcoming open days.</p>
      <EventList />
    </div>
    
  );

};

<Footer />

export default HomePage;