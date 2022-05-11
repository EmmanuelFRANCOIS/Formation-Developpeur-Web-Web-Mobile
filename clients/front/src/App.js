import React from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Home from './pages/Home';
import Test from './pages/Test';
import PageClient from './pages/PageClient';
import AjoutClient from './pages/AjoutClient';

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/test" element={<Test />} />
        <Route path="*" element={<Home />} /> 
        <Route path="/clients/:id" name="PageClient" element={<PageClient />} />
        <Route path="/clients/ajout" element={<AjoutClient />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
