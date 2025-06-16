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
        <div className="info">
          <p>
            <strong>La Plateforme_</strong>
             est une école du numérique et des nouvelles technologies co-fondée avec le Club Top 20 réunissant les grandes entreprises de la Métropole Aix Marseille. Elle comprend une offre de formations diversifiées destinées à former des développeurs web, logiciels, des experts en sécurité, des ingénieurs spécialisés en Intelligence Artificielle et systèmes immersifs, et des cadres d’entreprises au travers de cycles de formations continues.
          </p>
        </div>
        <br />
        <br />
        <div className="info">
         <strong>La Plateforme_</strong>
          est une école du numérique et des nouvelles technologies co-fondée avec le Club Top 20 réunissant les grandes entreprises de la Métropole Aix Marseille. Elle comprend une offre de formations diversifiées destinées à former des développeurs web, logiciels, des experts en sécurité, des ingénieurs spécialisés en Intelligence Artificielle et systèmes immersifs, et des cadres d’entreprises au travers de cycles de formations continues.
        </div>
        br
      
      </main>
      <Footer />
    </div>
    
  );
  
};

export default About;