import React from 'react';
import EventList from '../components/EventList';
import Navbar from '../components/NavBar';
import Footer from '../components/Footer';
import '../assets/css/HomePage.css';

const HomePage = () => {
  return (
    <div className="home-page">
      <Navbar />
      <main>
        <h1>Welcome to JPO Connect</h1>
        <p>Discover and register for our upcoming open days.</p>
        <EventList />
      </main>
      <Footer />
    </div>
  );
};

export default HomePage;