import { Footer } from 'react-router-dom';
import "../assets/css/Footer.css"; 
import logo from '../assets/images/logo-laplateforme-2024.png';

const Footer = () => {
  return (
    <footer className="footer">
      <div className="footer-container">
        <div className="logo-section">
          <img src={logo} alt="Logo laplateforme" className="logo" />
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
    </footer>
  );
};

export default Footer;