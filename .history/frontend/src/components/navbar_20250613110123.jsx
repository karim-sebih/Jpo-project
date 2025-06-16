import {NavLink} from 'react-router-dom';
import "../assets/css/NavBar.css"; 


const Navbar = () => {
  return (
    <nav>
      <div className="navbar">
       
          <li>
            <NavLink to="/">Home</NavLink>
          </li>
          <li>
            <NavLink to="/about">About</NavLink>
          </li>
          <li>
            <NavLink to="/contact">Contact</NavLink>
          </li>
        </u
      </div>
    </nav>
  );
};

export default Navbar;
