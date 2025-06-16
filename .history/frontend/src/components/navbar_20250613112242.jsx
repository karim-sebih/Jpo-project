import { NavLink } from 'react-router-dom';
import "../assets/css/NavBar.css"; 
import logo from '../assets/images/logo.png'; // Adjust the path to your logo image

const Navbar = () => {
  return (
    <nav className="nav-links">
      <div className="nav-container">
        <div className="logo-section">
          <img src={logo} alt="Logo l" className="logo" />
        </div>
        <ul>
          <li>
            <NavLink to="/">Home</NavLink>
          </li>
          <li>
            <NavLink to="/about">About</NavLink>
          </li>
          <li>
            <NavLink to="/contact">Contact</NavLink>
          </li>
          <li>
            <NavLink to="/locations">Locations</NavLink>
          </li>
          <li>
            <NavLink to="/login">Login</NavLink>
          </li>
          <li>
            <NavLink to="/signup">Sign up</NavLink>
          </li>
        </ul>
      </div>
    </nav>
  );
};

export default Navbar;