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
        <div className="content">
          <p>
            La grande école du numérique pour tous !<br />
            margin-left: 170Px;
    margin-right: 170px;
    padding: 30px 200px;
          </p>
        </div>
   
      </main>
      <Footer />
    </div>
  );
};

export default About;