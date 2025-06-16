import {NavLink} from 'react-router-dom';
import "../assets/css/NavBar.css"; 


const Navbar = () => {
  return (
    <nav class = "">
      <div className="navbar">
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
        </ul>
      </div>
    </nav>
  );
};

export default Navbar;
