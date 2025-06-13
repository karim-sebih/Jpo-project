import  './Home.css';
import Navbar from '../components/navbar';
import { useState } from 'react';

function A() {
  const [count, setCount] = useState(0);

    return (
        <>
        <Navbar />
        <div className="home-container">
            <h1>Welcome to the Home Page</h1>
            <div className="card">
            <button onClick={() => setCount((count) => count + 1)}>
                count is {count}
            </button>
            <p>
                Edit <code>src/pages/Home.jsx</code> and save to test HMR
            </p>
            </div>
            <p className="read-the-docs">
            Click on the links in the navbar to navigate
            </p>
        </div>
        </>
    );
}