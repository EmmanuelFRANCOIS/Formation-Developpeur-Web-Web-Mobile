import React from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Home from './pages/Home';
import Test from './pages/Test';
import PageClient from './pages/PageClient';
import AjoutClient from './pages/AjoutClient';
import SuppClient from './components/SuppClient';
import EditClient from './components/EditClient';

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/test" element={<Test />} />
        <Route path="*" element={<Home />} /> 
        <Route path="/clients/:id" name="PageClient" element={<PageClient />} />
        <Route path="/clients/ajout" element={<AjoutClient />} />
        <Route path="/clients/supp/:id" element={<SuppClient />} />
        <Route path="/clients/edit/:id" element={<EditClient />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
