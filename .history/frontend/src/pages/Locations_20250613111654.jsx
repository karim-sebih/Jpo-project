import { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import Navbar from '../components/NavBar.jsx';
import Router from "../api/Router.js";

<Navbar />
const Locations = () => {
    const { locationId } = useParams();

    const [locations, setLocations] = useState([]);
    const [success, setSuccess] = useState(false);
    const [loaded, setLoaded] = useState(false);

    useEffect(() => {
        const HttpLocations = Router("locations");
        const locationsData = async() => {
            setLoaded(false);
            setSuccess(false);
daz
            try {
                const fetchResult = locationId
                    ? await HttpLocations.getOne(locationId)
                    : await HttpLocations.getAll({ limit: 3 });

                if (fetchResult.success) {
                    const data = fetchResult.data;
                    setLocations(Array.isArray(data) ? data : [data]);
                    setSuccess(true);
                } else {
                    console.error(fetchResult.errors);
                }
            } catch (err) {
                console.error(err);
            } finally {
                setLoaded(true);
            }
        };

        locationsData();
    }, [locationId]);

    if (!loaded) {
        return <p>Chargement en cours...</p>;
    }

    if (!success) {
        return (
            <div>
                <p>Une erreur est survenue...</p>
                <p>{ locations?.message }</p>
            </div>
        )
    }

    return (
        <div>
        {locations.length > 0 ? (
            locations.map((location, index) => (
                <pre key={index}>
                    {JSON.stringify(location, null, 2)}
                </pre>
            ))
            ) : (
                <p>Aucune localisation à afficher.</p>
        )}
        </div>
    )
}

export default Locations;