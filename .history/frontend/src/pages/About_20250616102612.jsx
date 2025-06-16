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
            Des parcours de formations d’excellence en informatique aux frais de scolarité accessibles, ouverts à tous les talents, sans conditions de ressources et de diplômes.<br />
            Un lieu de rencontre entre entreprises et apprenants pour le bénéfice de tous !<br />
            Le digital c’est maintenant !<br />
          </p>
        </div>
   
      </main>
      <Footer />
    </div>
  );
};

export default About;