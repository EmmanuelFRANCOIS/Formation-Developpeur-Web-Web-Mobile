import React, { useEffect, useState } from "react";
import axios from "axios";
import { useParams } from 'react-router-dom'

const VoirClient = () => {
  const [client, setClient] = useState('');
  let { id } = useParams();

  useEffect(() => {
    axios.get(`http://localhost:4000/clients/${id}`).then((res) => {
      setClient(res.data);
    }).catch(err => {
      console.log(err);
    });
  }, []);

  
  return (
    <div class="container">
    <div class="media">
      <div class="media-body">
        <h5 class="mt-0 mb-1">{client.prenom} {client.nom}</h5>
        <p>
            Société : {client.societe} <br/>
            CA : {client.ca}
        </p>
      </div>
    </div>
    </div>
  );
}

export default VoirClient;