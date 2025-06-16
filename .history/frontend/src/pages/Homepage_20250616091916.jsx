import React from 'react';
import EventList from '../components/EventList';
import Navbar from '../components/NavBar';
import Footer from '../components/Footer';
import '../assets/css/HomePage.css';

const HomePage = () => {
  return (
    <div className="home-page">
 
      <main>
       <div className="intro">
        <h1>Bienvenue à LaPlateforme</h1>
        <p>La grande école du numérique pour tous !
Des parcours de formations d’excellence en informatique aux frais de scolarité accessibles, ouverts à tous les talents, sans conditions de ressources et de diplômes.

Un lieu de rencontre entre entreprises et apprenants pour le bénéfice de tous !

Le digital c’est maintenant !</p>
<br />
<p>inscrivez-vous aux Journées Portes Ouvertes de La Plateforme</p>
<button className='event-button'>
  Découvrir nos prochaines dates
</button>
</div> 

<div className="description">
  <H2>Pourquoi participé à une Jpo ?</H2>
  <p>Découvrer nos formations, rencontrez notre équipe, échangez avec les étudiants et explorez</p>
</div>
        <EventList />
      </main>
      <Footer />
    </div>
  );
};

export default HomePage;