import React, { useContext, useEffect, useState } from 'react';
import { AuthContext } from '../context/AuthContext';
import { getAdminStats } from '../services/api';

const AdminDashboard = () => {
  const { user } = useContext(AuthContext);
  const [stats, setStats] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    if (user && user.role === 1) { // Assuming role 1 is admin
      const fetchStats = async () => {
        try {
          const data = await getAdminStats();
          setStats(data);
        } catch (err) {
          setError(err.message);
        } finally {
          setLoading(false);
        }
      };
      
      fetchStats();
    }
  }, [user]);

  if (!user || user.role !== 1) {
    return <div>Access denied. Admin privileges required.</div>;
  }

  if (loading) return <div>Loading dashboard...</div>;
  if (error) return <div>Error: {error}</div>;

  return (
    <div className="admin-dashboard">
      <h2>Admin Dashboard</h2>
      <div className="stats">
        <h3>Statistics</h3>
        <p>Total Events: {stats.total_events}</p>
        {/* Add more stats as needed */}
      </div>
      {/* Add more admin features here */}
    </div>
  );
};

export default AdminDashboard;