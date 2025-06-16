import React, { useState, useEffect } from 'react';
import PropTypes from 'prop-types';
import { loginUser, validateToken } from '../services/api';

export const AuthContextProvider = ({ children }) => {
  const [user, setUser] = useState(null);
  const [token, setToken] = useState(null);
  const [isAuthenticated, setIsAuthenticated] = useState(false);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const initializeAuth = async () => {
      try {
        const storedUser = localStorage.getItem('user');
        const storedToken = localStorage.getItem('token');
        if (storedUser && storedToken) {
          const parsedUser = JSON.parse(storedUser);
          const isValid = await validateToken(storedToken);
          if (isValid) {
            setUser(parsedUser);
            setToken(storedToken);
            setIsAuthenticated(true);
          } else {
            localStorage.removeItem('user');
            localStorage.removeItem('token');
          }
        }
      } catch (error) {
        console.error('Error initializing auth:', error);
        localStorage.removeItem('user');
        localStorage.removeItem('token');
      } finally {
        setLoading(false);
      }
    };

    initializeAuth();
  }, []);

  const login = async ({ email, password }) => {
    try {
      const response = await loginUser({ email, password });
      if (response.user && response.token) {
        setUser(response.user);
        setToken(response.token);
        setIsAuthenticated(true);
        localStorage.setItem('user', JSON.stringify(response.user));
        localStorage.setItem('token', response.token);
        return { success: true };
      }
      return { success: false, error: response.error || 'Invalid credentials' };
    } catch (error) {
      return { success: false, error: error.message || 'Login failed' };
    }
  };

  const logout = () => {
    setUser(null);
    setToken(null);
    setIsAuthenticated(false);
    localStorage.removeItem('user');
    localStorage.removeItem('token');
  };

  return (
    <AuthContext.Provider
      value={{ user, token, isAuthenticated, loading, login, logout }}
    >
      {children}
    </AuthContext.Provider>
  );
};

AuthContextProvider.propTypes = {
  children: PropTypes.node.isRequired,
};

export default AuthContextProvider;