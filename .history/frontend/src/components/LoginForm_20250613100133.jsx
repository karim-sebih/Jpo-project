import React, { useState, useContext } from 'react';
import PropTypes from 'prop-types';
import { AuthContext } from '../context/AuthContext';
import { loginUser } from '../services/api.js';

const LoginForm = ({ onSwitchToRegister }) => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);
  const { login } = useContext(AuthContext);

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError('');
    setLoading(true);

    try {
      const response = await loginUser({ email, password }); // Use loginUser API
      if (response.success) {
        await login(response.data); // Update auth context with API response data
      } else {
        setError(response.error || 'Invalid email or password');
      }
    } catch (err) {
      setError(err.message || 'An error occurred during login');
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="auth-form">
      <h2>Login</h2>
      {error && (
        <div className="error" role="alert" aria-live="assertive">
          {error}
        </div>
      )}
      <form onSubmit={handleSubmit} noValidate>
        <div>
          <label htmlFor="email">Email:</label>
          <input
            id="email"
            type="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
            aria-describedby={error ? 'error-message' : undefined}
          />
        </div>
        <div>
          <label htmlFor="password">Password:</label>
          <input
            id="password"
            type="password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            required
            aria-describedby={error ? 'error-message' : undefined}
          />
        </div>
        <button type="submit" disabled={loading} aria-busy={loading}>
          {loading ? 'Logging in...' : 'Login'}
        </button>
      </form>
      <p>
        Don't have an account?{' '}
        <button
          type="button"
          onClick={onSwitchToRegister}
          className="link-button"
          aria-label="Switch to registration form"
        >
          Register here
        </button>
      </p>
    </div>
  );
};

LoginForm.propTypes = {
  onSwitchToRegister: PropTypes.func.isRequired,
};

export default LoginForm;