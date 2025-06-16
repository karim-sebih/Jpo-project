import {NavLink} from 'react-router-dom';
import "../assets/css/NavBar.css"; 


const Navbar = () => {
  return (
    <nav class = "nav-links">
     
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
            <NavLink to ="/Locations">Locations</NavLink>
          </li>
          <li>
            <NavLink to="/login">Login</NavLink>
          </li>
          
          
        </ul>
      
    </nav>
  );
};

export default Navbar;
