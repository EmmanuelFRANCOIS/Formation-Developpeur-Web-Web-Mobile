import React, { useEffect, useState } from "react";
import axios from "axios";
import { useParams } from 'react-router-dom';
import Header from "./../components/Header";
import { Link } from "react-router-dom";

const SuppClient = () => {
  const [succes, setsucces] = useState(false);

  let { id } = useParams();
  useEffect(() => {
    axios.delete(`http://localhost:4000/clients/${id}`).then((res) => {
      console.log(res);
      setsucces(true);
    }).catch(err => {
      console.log(err);
    });
  }, []);

  let classeAlert = succes === true ? "success" : "danger";
  classeAlert = "alert alert-" + classeAlert;

  return (
    <>
      <Header />
      <div class="container">
        <div class="row">
          <div class="col-md-8 offset-md-2 mt-5">
            <div className={classeAlert} role="alert">
              {succes === true ? `Le client ayant l'id ${id} a été supprimé avec succes.` : "Client introuvable."}<br/>
              <Link to={'/'} className="alert-link">Retour à la liste des clients</Link>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}

export default SuppClient;