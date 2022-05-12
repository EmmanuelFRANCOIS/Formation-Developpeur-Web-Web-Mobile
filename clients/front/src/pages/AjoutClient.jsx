import React, { useState, useId } from "react";
import axios from "axios";
import Client from "../components/Clients";

const AjoutClient = () => {
  const [prenom, setPrenom] = useState('');
  const [nom, setNom] = useState('');
  const [societe, setSociete] = useState('');
  const [ca, setCa] = useState('');
  const [ajout, setAjout] = useState(false);
  const [client, setClient] = useState('');

  const id = useId();

  const modifPrenom = (e) => {
    setPrenom(e.target.value);
  }
  const modifNom = (e) => {
    setNom(e.target.value);
  }
  const modifSociete = (e) => {
    setSociete(e.target.value);
  }
  const modifCa = (e) => {
    setCa(e.target.value);
  }

  const ajoutClient = (e) => {
    e.preventDefault();

    axios.post("http://localhost:4000/clients", {
      id,
      prenom,
      nom,
      societe,
      ca,
    }).then((res) => {
      setAjout(true);
      setClient(res.data);
      setPrenom("");
      setNom("");
      setSociete("");
      setCa("");
    }).catch(err => {
      console.log(err);
    });

  };

  const form = <form>
    <div class="form-group">
      <label for="prenom">Prénom</label>
      <input type="text" className="form-control" id="prenom" onChange={modifPrenom} />
    </div>

    <div class="form-group">
      <label for="nom">Nom</label>
      <input type="text" className="form-control" id="nom" onChange={modifNom} />
    </div>

    <div class="form-group">
      <label for="societe">Société</label>
      <input type="text" className="form-control" id="societe" onChange={modifSociete} />
    </div>

    <div class="form-group">
      <label for="ca">CA</label>
      <input type="number" className="form-control" id="ca" onChange={modifCa} />
    </div>
    <input type="submit" class="btn btn-primary m-3" value="Ajouter" onClick={ajoutClient} />
    <input type="reset" class="btn btn-danger m-3" value="Réinitialiser" />
  </form>;


  return (
    <div className="container">
      <div className="row">
        <div className="col-md-6 offset-md-3">
          {!ajout ? form :
            <div>
              <Client key={client.id} client={client}/>
              <br/>
              <input type="submit" class="btn btn-primary m-3" value="Ajouter" onClick={ajoutClient} />
            </div>
          }
        </div>
      </div>
    </div>
  );
}

export default AjoutClient;