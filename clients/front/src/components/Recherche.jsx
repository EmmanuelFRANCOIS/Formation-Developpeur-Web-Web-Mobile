import React, { useEffect, useState } from "react";
import axios from "axios";
import "bootstrap/dist/css/bootstrap.css";
import Client from "./Clients";

const Recherche = () => {
  const [clients, setClients] = useState([]);
  const [rechercheClients, setRechercheClients] = useState([]);
  const [tri, setTri] = useState(null);

  useEffect(() => {
    axios
      .get(`http://localhost:4000/clients`)
      .then((res) => {
        setClients(res.data);
        setRechercheClients(res.data);
      })
      .catch((err) => {
        console.log(err);
      });
  }, []);

  const typeTri = (e) => {
    setTri(e.target.getAttribute("value"));
  };

  const triTab = (a, b) => {
    if (tri === "top") {
      return b.ca - a.ca;
    } else if (tri === "down") {
      return a.ca - b.ca;
    }
  };

  const chercher = (e) => {
    const rech = e.target.value;
    if (rech !== "") {
      const rtRecherche = clients.filter((client) => {
        return client.societe.toLowerCase().startsWith(rech.toLowerCase());
      });
      console.log(rtRecherche);
      setRechercheClients(rtRecherche);
    } else {
      setRechercheClients(clients);
    }
  };

  return (
    <div>
      <div className="container-fluid">
        <form className="container d-flex justify-content-end">
          <div className="me-3 top" id="top" value="top" onClick={typeTri}>
            Top
          </div>
          <div className="me-3 down" id="down" value="down" onClick={typeTri}>
            Down
          </div>
          <div className="col-2 form-group">
            <input
              type="text"
              className="form-control"
              id="societe"
              onChange={chercher}
            />
          </div>
          <input
            type="submit"
            className="col-1 btn btn-primary"
            value="recherche"
          />
        </form>
      </div>
      <div className="container">
        <div className="row">
        {rechercheClients.length === 0 ? <h1>aucun client trouvé</h1> :
            rechercheClients
              .sort(triTab)
              .map((client) => {
                return (
                  <Client key={client.id} client={client} />
                );
          })}
        </div>
      </div>
    </div>
  );
};

export default Recherche;
