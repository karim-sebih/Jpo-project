import React, { useState, useEffect, useContext } from 'react';
import { AuthContext } from '../context/AuthContext';
import { registerForEvent, unregisterFromEvent } from '../services/api';

const EventCard = ({ event, onUpdate }) => {
  const { user, isAuthenticated } = useContext(AuthContext);
  const [isRegistered, setIsRegistered] = useState(false);
  const [loading, setLoading] = useState(false);

  useEffect(() => {
    // Check if user is registered for this event
    // In a real app, you would check against the API
    setIsRegistered(false);
  }, [event, user]);

  const handleRegister = async () => {
    if (!isAuthenticated) {
      alert('Please login to register for events');
      return;
    }
    
    setLoading(true);
    try {
      await registerForEvent(event.id, user.id);
      setIsRegistered(true);
      onUpdate && onUpdate();
    } catch (error) {
      console.error('Registration failed:', error);
    } finally {
      setLoading(false);
    }
  };

  const handleUnregister = async () => {
    setLoading(true);
    try {
      await unregisterFromEvent(event.id, user.id);
      setIsRegistered(false);
      onUpdate && onUpdate();
    } catch (error) {
      console.error('Unregistration failed:', error);
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="event-card">
      <h3>{event.name}</h3>
      <p>{new Date(event.time).toLocaleString()}</p>
      <p>{event.adresse}, {event.cp} {event.ville}</p>
      <p>Capacity: {event.capacité}</p>
      
      {isAuthenticated && (
        isRegistered ? (
          <button onClick={handleUnregister} disabled={loading}>
            {loading ? 'Processing...' : 'Unregister'}
          </button>
        ) : (
          <button onClick={handleRegister} disabled={loading}>
            {loading ? 'Processing...' : 'Register'}
          </button>
        )
      )}
    </div>
  );
};

export default EventCard;