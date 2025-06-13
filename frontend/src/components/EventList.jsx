import React, { useState, useEffect } from 'react';
import { getEvents } from '../services/api';
import EventCard from './EventCard';

const EventList = () => {
  const [events, setEvents] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchEvents = async () => {
      try {
        const data = await getEvents();
        setEvents(data);
      } catch (err) {
        setError(err.message);
      } finally {
        setLoading(false);
      }
    };

    fetchEvents();
  }, []);

  const handleEventUpdate = async () => {
    try {
      const data = await getEvents();
      setEvents(data);
    } catch (err) {
      console.error('Failed to refresh events:', err);
    }
  };

  if (loading) return <div>Loading events...</div>;
  if (error) return <div>Error: {error}</div>;

  return (
    <div className="event-list">
      <h2>Upcoming Open Days</h2>
      {events.length === 0 ? (
        <p>No upcoming events</p>
      ) : (
        events.map(event => (
          <EventCard 
            key={event.id} 
            event={event} 
            onUpdate={handleEventUpdate}
          />
        ))
      )}
    </div>
  );
};

export default EventList;