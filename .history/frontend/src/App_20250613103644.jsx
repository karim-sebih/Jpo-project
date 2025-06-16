import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { AuthProvider } from './context/AuthContext';
import Navbar from './components/NavBar';
import HomePage from './pages/HomePage'
import LoginPage from './pages/LoginPage';
import AdminDashboard from './pages/AdminDashboard';
import './assets/css/App.css'; 

function App() {
  return (
    <AuthProvider>
      <Router>
        <div className="app">
          <Navbar />
          <div className="content">
            <Routes>
              <Route path="/" element={<HomePage />} />
              <Route path="/login" element={<LoginPage />} />
              {/* <Route path="/register" element={<RegisterPage />} /> */}
              <Route path="/admin" element={<AdminDashboard />} />
            </Routes>
          </div>
        </div>
      </Router>
    </AuthProvider>
  );
}

export default App;