import React from 'react';

import Navbar from '../components/NavBar';
import Footer from '../components/Footer';
import '../assets/css/About.css';

<Navbar />

const About = () => {
  return (  
    <div className="about">

      <main>
        <div className="intro">
          <h1>Qui Sommes-nous ?</h1>
          <hr />
          
         
        </div>
   
      </main>
      <Footer />
    </div>
  );
};

export default About;