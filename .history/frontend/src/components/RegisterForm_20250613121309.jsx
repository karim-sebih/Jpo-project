import React, { useState } from 'react';
import { registerUser } from '../services/api';
impor

const RegisterForm = ({ onSwitchToLogin }) => {
  const [formData, setFormData] = useState({
    nom: '',
    prenom: '',
    email: '',
    password: '',
  });
  const [error, setError] = useState('');
  const [success, setSuccess] = useState(false);
  const [loading, setLoading] = useState(false);

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = async (e) => {
  e.preventDefault();
  setError('');
  setLoading(true);
  
  try {
    const response = await registerUser(formData);
    if (response.error) {
      setError(response.error);
    } else {
      setSuccess(true);
    }
  } catch (err) {
    console.error("Registration error:", err);
    setError('Failed to connect to server. Please try again later.');
  } finally {
    setLoading(false);
  }
};

  if (success) {
    return (
      <div className="auth-form">
        <h2>Registration Successful!</h2>
        <p>You can now login with your credentials.</p>
        <button onClick={onSwitchToLogin} className="link-button">
          Go to Login
        </button>
      </div>
    );
  }

  return (
    <div className="auth-form">
      <h2>Register</h2>
      {error && <div className="error">{error}</div>}
      <form onSubmit={handleSubmit}>
        <div>
          <label>First Name:</label>
          <input
            type="text"
            name="prenom"
            value={formData.prenom}
            onChange={handleChange}
            required
          />
        </div>
        <div>
          <label>Last Name:</label>
          <input
            type="text"
            name="nom"
            value={formData.nom}
            onChange={handleChange}
            required
          />
        </div>
        <div>
          <label>Email:</label>
          <input
            type="email"
            name="email"
            value={formData.email}
            onChange={handleChange}
            required
          />
        </div>
        <div>
          <label>Password:</label>
          <input
            type="password"
            name="password"
            value={formData.password}
            onChange={handleChange}
            required
          />
        </div>
        <button type="submit" disabled={loading}>
          {loading ? 'Registering...' : 'Register'}
        </button>
      </form>
      <p>
        Already have an account?{' '}
        <button onClick={onSwitchToLogin} className="link-button">
          Login here
        </button>
      </p>
    </div>
  );
};

export default RegisterForm;