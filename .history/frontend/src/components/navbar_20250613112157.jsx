import {NavLink} from 'react-router-dom';
import "../assets/css/NavBar.css"; 


const Navbar = () => {
  return (
    <div className="logo">
      <img src="/logo.png" alt="Logo" />
      <h1>JPO Connect</h1>
    </div>
    <nav className="nav-links">
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
    </nav>
    
  );
};

export default Navbar;
