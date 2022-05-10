import React from "react";

const Client = ({client}) => {
  return (
    <div class="card col-md-3 m-3">
      <div class="card-body">
        <h5 class="card-title">{client.prenom} {client.nom}</h5>
        <p class="card-text">{client.societe}  - {client.ca}</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  );
}

export default Client;
