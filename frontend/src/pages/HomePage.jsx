import React from 'react';
import EventList from '../components/EventList';

const HomePage = () => {
  return (
    <div className="home-page">
      <h1>Welcome to JPO Connect</h1>
      <p>Discover and register for our upcoming open days.</p>
      <EventList />
    </div>
  );
};

export default HomePage;