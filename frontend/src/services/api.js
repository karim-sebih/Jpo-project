const API_BASE_URL = 'http://localhost:8000/api';

// Helper function for handling responses
const handleResponse = async (response) => {
  if (!response.ok) {
    const errorData = await response.json().catch(() => ({}));
    throw new Error(errorData.error || `HTTP error! status: ${response.status}`);
  }
  return response.json();
};

export const registerUser = async (userData) => {
  try {
    const response = await fetch(`${API_BASE_URL}/register`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(userData),
      credentials: 'include'
    });
    return await handleResponse(response);
  } catch (error) {
    console.error('Registration error:', error);
    throw error;
  }
};

export const loginUser = async (credentials) => {
  try {
    const response = await fetch(`${API_BASE_URL}/login`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(credentials),
      credentials: 'include'
    });
    return await handleResponse(response);
  } catch (error) {
    console.error('Login error:', error);
    throw error;
  }
};

export const getEvents = async () => {
  try {
    const response = await fetch(`${API_BASE_URL}/events`);
    return await handleResponse(response);
  } catch (error) {
    console.error('Get events error:', error);
    throw error;
  }
};

export const getEvent = async (id) => {
  try {
    const response = await fetch(`${API_BASE_URL}/events/${id}`);
    return await handleResponse(response);
  } catch (error) {
    console.error('Get event error:', error);
    throw error;
  }
};

export const registerForEvent = async (eventId, userId) => {
  try {
    const response = await fetch(`${API_BASE_URL}/events/${eventId}/register`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ user_id: userId }),
      credentials: 'include'
    });
    return await handleResponse(response);
  } catch (error) {
    console.error('Register for event error:', error);
    throw error;
  }
};

export const unregisterFromEvent = async (eventId, userId) => {
  try {
    const response = await fetch(`${API_BASE_URL}/events/${eventId}/unregister`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ user_id: userId }),
      credentials: 'include'
    });
    return await handleResponse(response);
  } catch (error) {
    console.error('Unregister from event error:', error);
    throw error;
  }
};

export const addComment = async (eventId, userId, message) => {
  try {
    const response = await fetch(`${API_BASE_URL}/events/${eventId}/comments`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ user_id: userId, message }),
      credentials: 'include'
    });
    return await handleResponse(response);
  } catch (error) {
    console.error('Add comment error:', error);
    throw error;
  }
};

// Admin functions
export const deleteComment = async (commentId) => {
  try {
    const response = await fetch(`${API_BASE_URL}/admin/comments/${commentId}`, {
      method: 'DELETE',
      credentials: 'include'
    });
    return await handleResponse(response);
  } catch (error) {
    console.error('Delete comment error:', error);
    throw error;
  }
};

export const getAdminStats = async () => {
  try {
    const response = await fetch(`${API_BASE_URL}/admin/stats`, {
      credentials: 'include'
    });
    return await handleResponse(response);
  } catch (error) {
    console.error('Get admin stats error:', error);
    throw error;
  }
};