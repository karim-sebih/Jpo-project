import { NavLink } from 'react-router-dom';
import '../assets/css/Footer.css';

const Footer = () => {
  return (
    <footer className="footer">
      <div className="footer-container">
        {/* Uncomment if you want to include a logo or site title */}
        {/* <div className="footer-logo">
          <img src="../assets/images/logo-laplateforme-2024.png" alt="Logo laplateforme" className="logo" />
        </div> */}
        <ul className="footer-links">
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
        </ul>
        <div className="footer-copyright">
          <p>&copy; {new Date().getFullYear()} La Plateforme. All rights reserved.</p>
        </div>
      </div>
    </footer>
  );
};

export default Footer;