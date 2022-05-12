import React, { useState, useEffect } from "react";
import Header from "./../components/Header";
import { useParams } from 'react-router-dom';
import axios from "axios";
import { Link } from "react-router-dom";

const MajClient = () => {
  const [prenom, setPrenom] = useState('');
  const [nom, setNom] = useState('');
  const [societe, setSociete] = useState('');
  const [ca, setCa] = useState('');
  const [maj, setMaj] = useState(false);

  let { id } = useParams();

  useEffect(() => {
    axios.get(`http://localhost:4000/clients/${id}`).then((res) => {
      console.log(res);
      setPrenom(res.data.prenom);
      setNom(res.data.nom);
      setSociete(res.data.societe);
      setCa(res.data.ca);
    }).catch(err => {
      console.log(err);
    });
  }, []);

  const majClient = (e) => {
    e.preventDefault();

    axios.put(`http://localhost:4000/clients/${id}`, {
      prenom,
      nom,
      societe,
      ca,
    }).then((res) => {
      setMaj(true);
    }).catch(err => {
      console.log(err);
    });

  }

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

  const form = <form>
    <div className="form-group">
      <label for="prenom">Prénom</label>
      <input type="text" className="form-control" id="prenom" onChange={modifPrenom} value={prenom} />
    </div>

    <div className="form-group">
      <label for="nom">Nom</label>
      <input type="text" className="form-control" id="nom" onChange={modifNom} value={nom} />
    </div>

    <div className="form-group">
      <label for="societe">Société</label>
      <input type="text" className="form-control" id="societe" onChange={modifSociete} value={societe} />
    </div>

    <div className="form-group">
      <label for="ca">CA</label>
      <input type="number" className="form-control" id="ca" onChange={modifCa} value={ca} />
    </div>
    <input type="submit" className="btn btn-primary m-3" value="Modifier" onClick={majClient} />
    <input type="reset" className="btn btn-danger m-3" value="Réinitialiser" />
  </form>;

const message = maj === false ? "" : 
<div class="alert alert-success" role="alert">
  Mise à jour faite avec succes. <br/>
  <Link to={'/'} className="alert-link">Retour à la liste des clients</Link>
</div>

return (

  <>
    <Header />
    <div className="container">
      <div className="row">
        <div className="col-md-8 offset-md-2 mt-5">
          {message}
          {form}
        </div>
      </div>
    </div>
  </>



);
}

export default MajClient;