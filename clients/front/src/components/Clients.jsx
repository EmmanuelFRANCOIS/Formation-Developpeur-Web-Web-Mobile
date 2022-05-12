import React from "react";
import { Link } from "react-router-dom";

const Client = ({client}) => {
  return (
    <div class="card col-md-3 m-3">
      <div class="card-body">
        <h5 class="card-title">{client.prenom} {client.nom}</h5>
        <p class="card-text">{client.societe}  - {client.ca}</p>
        <Link to={`clients/${client.id}`} className="btn btn-primary">Voir</Link>
        <Link to={`clients/supp/${client.id}`} className="btn btn-danger ms-2">Supprimer</Link>
        <Link to={`clients/edit/${client.id}`} className="btn btn-warning ms-2">Modifier</Link>
      </div>
    </div>
  );
}

export default Client;
