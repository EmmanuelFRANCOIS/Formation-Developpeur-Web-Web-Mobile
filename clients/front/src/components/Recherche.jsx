import React, { useEffect, useState } from "react";
import axios from "axios";
import 'bootstrap/dist/css/bootstrap.css';
import Client from "./Clients";

const Recherche = () => {
  const [clients, setClients] = useState([]);

  useEffect(() => {
axios.get(`http://localhost:4000/clients`).then((res) => {
      setClients(res.data);
    }).catch(err => {
      console.log(err);
    });
  }, []);
  return (
    <div>
      <div className="container">
        <div className="row">
          <form className="col">
            <div className="form-group mb-2 col-12 d-flex justify-content-between">
              <input type="text" className="col form-control" id="societe" />
              <input type="submit" className="col-4 btn btn-primary" value="recherche" />
            </div>
          </form>
        </div>
      </div>
      <div className="container">
        <div className="row">
              {clients.map((client) => {
                 return <Client key={client.id} client={client} />;
              })}
        </div>
      </div>
    </div>
  );
};

export default Recherche;