import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';

import Navbar from './components/NavBar';
import HomePage from './pages/HomePage';
import About from './pages/About';
import c
import LoginPage from './pages/LoginPage';
import AdminDashboard from './pages/AdminDashboard';
import './assets/css/App.css'; 

function App() {
  return (
        <div className="app">
          <Navbar />
          <div className="content">
            <Routes>
              
              <Route path="/" element={<HomePage />} />
              <Route path="/login" element={<LoginPage />} />
              <Route path="/about" element={<About />} />
              {/* <Route path="/register" element={<RegisterPage />} /> */}
              <Route path="/admin" element={<AdminDashboard />} />
            </Routes>
          </div>
        </div>
    
    
  );
}

export default App;