import React from 'react';

import Navbar from '../components/NavBar';
import Footer from '../components/Footer';
import '../assets/css/contact.css';

<Navbar />

const Contact = () => {
  return (  
    <div className="contact">

      <main>
<p>Vous avez une question ? Une demande particulière ? N'hésitez pas à nous contacter, notre équipe vous répondra dans les plus brefs délais.</p>
      <br />
       <div className="formulaire">
      <div className="mini-info">
      <p>Téléphone : 04.84.89.43.69</p>
      <p> 8 rue d'Hozier , 13002 Marseille</p>
      </div>
      <h2>Formulaire de Contact</h2>
      <form>
        <div className="form-group">
          <label htmlFor="name">Nom</label>b
          <input type="text" id="name" name="name" required />
        </div>
        <div className="form-group">
          <label htmlFor="email">Email</label>
          <input type="email" id="email" name="email" required />
        </div>
        <div className="form-group">
          <label htmlFor="message">Message</label>
          <textarea id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit">Envoyer</button>
      </form>
     </div>
     <br />
     <br />
      </main>
      <Footer />
    </div>
    
  );
  
};

export default Contact;