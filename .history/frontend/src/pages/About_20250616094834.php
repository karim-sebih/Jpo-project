im

const HomePage = () => {
  return (
    <div className="about">
 
      <main>
       <div className="intro">
        <h1>Bienvenue à LaPlateforme</h1>
        <p>La grande école du numérique pour tous !
Des parcours de formations d’excellence en informatique aux frais de scolarité accessibles, ouverts à tous les talents, sans conditions de ressources et de diplômes.

Un lieu de rencontre entre entreprises et apprenants pour le bénéfice de tous !

Le digital c’est maintenant !</p>
<br />
  </div>
        <EventList />
      </main>
      <Footer />
    </div>
  );
};

export default HomePage;